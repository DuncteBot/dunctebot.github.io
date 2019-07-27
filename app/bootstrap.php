<?php

use App\Routes\Router;
use App\View\BladeLoader;

require __DIR__ .'/../vendor/autoload.php';

$blade = new BladeLoader(
    __DIR__ . '/../resources/views'
);
$router = new Router($blade);

$router->handle();
