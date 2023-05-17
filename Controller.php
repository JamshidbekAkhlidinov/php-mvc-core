<?php
/*
 *   Jamshidbek Akhlidinov
 *   4 - 5 2023 19:13:32
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public array $middlewares = [];
    public string $action;

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddlewares(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

}