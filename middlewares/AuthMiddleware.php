<?php
/*
 *   Jamshidbek Akhlidinov
 *   15 - 5 2023 1:17:17
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace akhlidinov\phpmvc\middlewares;

use akhlidinov\phpmvc\Application;
use akhlidinov\phpmvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }


    public function execute()
    {
        if (Application::isGust()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }


}