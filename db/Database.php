<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:43:46
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\db;
use app\core\Application;

class Database
{
    public \PDO $pdo;

    public function __construct(array $db)
    {
        $dsn = $db['dsn'] ?? '';
        $user = $db['user'] ?? '';
        $password = $db['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare($sql)
    {
        return$this->pdo->prepare($sql);
    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigration = $this->getApplicationMigrations();
        $files = scandir(Application::$ROOT_DIR . "/migrations");
        $toApplyMigration = array_diff($files, $appliedMigration);
        $newMigrations = [];
        foreach ($toApplyMigration as $migration) {
            if ($migration === '.' || $migration == '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . "/migrations/" . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                crated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                                 
            ) ENGINE=INNODB;
        ");
    }

    public function getApplicationMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function log(string $message)
    {
        echo "[" . date('d-M Y H:i:s') . "] - " . $message . PHP_EOL;
    }
}