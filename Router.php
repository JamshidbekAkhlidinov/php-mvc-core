<?php
/*
 *   Jamshidbek Akhlidinov
 *   4 - 5 2023 11:49:10
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace akhlidinov\phpmvc;

use akhlidinov\phpmvc\exception\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var $controller Controller
             */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView(string $view, $params = [])
    {
        Application::$app->view->renderView($view, $params);
    }

}