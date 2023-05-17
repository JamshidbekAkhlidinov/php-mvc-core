<?php
/*
 *   Jamshidbek Akhlidinov
 *   15 - 5 2023 1:15:27
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}