<?php
/*
 *   Jamshidbek Akhlidinov
 *   4 - 5 2023 13:44:34
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $string)
    {
        header('location: ' . $string);
    }
}