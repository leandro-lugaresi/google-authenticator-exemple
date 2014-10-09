<?php

namespace App;

class Bootstrap
{
    protected $routes;

    public function __construct($routes)
    {
        $this->setRoutes($routes);
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function run($url)
    {
        foreach ($this->routes as $route => $config) {
            if ($url == $config['route']) {
                $class = "\\App\\Controllers\\".ucfirst($config['controller']);
                $controller = new $class;
                $controller->$config['action']();

                return true;
            }
        }

        return false;
    }

    public function getUrl()
    {
        $pattern = "#([a-zA-Z0-9\/]+)(\?.*)?#";
        $x = preg_replace($pattern,"$1", $_SERVER['REQUEST_URI']);

        return $x;
    }

}
