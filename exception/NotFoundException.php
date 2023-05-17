<?php
/*
 *   Jamshidbek Akhlidinov
 *   15 - 5 2023 1:26:37
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\exception;

class NotFoundException extends \Exception
{
    protected $message = "Page not found";

    protected $code = 404;

}