<?php

namespace App\Routes;

use App\View\BladeLoader;
use FastRoute;

class Router {

    private $blade;

    private $routeHandler;
    /**
     * @var FastRoute\Dispatcher
     */
    private $dispatcher;

    /**
     * Router constructor.
     *
     * @param BladeLoader $blade
     */
    public function __construct(BladeLoader $blade)
    {
        $this->blade = $blade;
        $this->routeHandler = new RouteHandler();

        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
            $router->addRoute('GET', '/', 'home');
            $router->addRoute('GET', '/commands', 'commands');
            $router->addRoute('GET', '/suggest', 'suggest');
            $router->addRoute('GET', '/commands_botlist', 'commandsBotlist');
            $router->addRoute('GET', '/flags', 'flags');
        });
    }


    public function handle()
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                header(httpCodeToHeaderString(404), true, 404);
                echo $this->blade->view('errors.404');
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                echo $this->routeHandler->$handler($this->blade, $vars);
                break;
        }
    }
}
