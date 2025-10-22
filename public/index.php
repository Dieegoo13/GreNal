<?php
require_once '../vendor/autoload.php';

use Core\Router;
use App\Controllers\GameController;

require_once '../vendor/autoload.php';

// Instancia o roteador
$router = new Router();

// Define as rotas da aplicação
$router->setRoutes([
    '/' => [GameController::class, 'index'],
    '/insert' => [GameController::class, 'insertGame'],
    '/estatisticas' => [GameController::class, 'estatisticas'],
]);

// echo '<pre>';
// print_r($router->getUrl());
// echo '</pre>';
