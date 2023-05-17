<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:48:12
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core;

use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName();
}