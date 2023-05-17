<?php
/*
 *   Jamshidbek Akhlidinov
 *   15 - 5 2023 1:26:37
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = "You don't have permission to access this page";

    protected $code = 403;

}