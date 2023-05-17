<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:43:37
 *   https://github.com/JamshidbekAkhlidinov
 */
namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public static function primaryKey()
    {
        return 'id';
    }

    public function save()
    {
        $attributes = $this->attributes();
        $tableName = static::tableName();

        try {
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("
                    INSERT INTO $tableName 
                        (" . implode(',', $attributes) . ") 
                    VALUES
                        (" . implode(',', $params) . ")
                     ");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function findOne($condition)
    {
        $tableName = static::tableName();;
        $attributes = array_keys($condition);
        $sql = implode(' AND ', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($condition as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }



}

