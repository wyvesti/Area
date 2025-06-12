<?php

namespace App\Core;
use App\View\ErrorView;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function init()
    {
        $currentPath = $_SERVER['PATH_INFO'] ?? "";

        foreach ($this->routes as $path => $controller) {
            if (trim($currentPath, "/") == trim($path, "/")) {
                $controller->processRequest();
                return;
            }
        }

        $errorView = new ErrorView("Page not found : there is no route for $currentPath");
        $errorView->render();

        http_response_code(404);
    }
}
