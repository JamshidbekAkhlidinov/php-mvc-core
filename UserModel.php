<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:48:12
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace akhlidinov\phpmvc;

use akhlidinov\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName();
}