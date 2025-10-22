<?php

namespace Core;

class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function initRoutes()
    {
        $routes['home'] = [
            'route' => '/',
            'controller' => 'GameController',
            'action' => 'index'
        ];

        $routes['create'] = [
            'route' => '/create',
            'controller' => 'GameController',
            'action' => 'create'
        ];

        // Rotas de API (chamadas via JavaScript)
        $routes['insert-game'] = [
            'route' => '/insert-game',
            'controller' => 'GameController',
            'action' => 'insertGame'
        ];

        $routes['listar-jogos'] = [
            'route' => '/listar-jogos',
            'controller' => 'GameController',
            'action' => 'listarJogos'
        ];

        $routes['estatisticas'] = [
            'route' => '/estatisticas',
            'controller' => 'GameController',
            'action' => 'estatisticas'
        ];

        $this->setRoutes($routes);
    }


    public function run($url)
    {
        foreach ($this->routes as $route) {
            if ($url === $route['route']) {
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $controller = new $controllerClass();
                $action = $route['action'];
                $controller->$action();
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Rota não encontrada']);
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
