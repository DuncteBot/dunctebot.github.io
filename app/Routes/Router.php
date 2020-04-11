<?php
/**
 *      Copyright 2017-2020 Duncan "duncte123" Sterken
 *
 *      Licensed under the Apache License, Version 2.0 (the "License");
 *      you may not use this file except in compliance with the License.
 *      You may obtain a copy of the License at
 *
 *          http://www.apache.org/licenses/LICENSE-2.0
 *
 *      Unless required by applicable law or agreed to in writing, software
 *      distributed under the License is distributed on an "AS IS" BASIS,
 *      WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *      See the License for the specific language governing permissions and
 *      limitations under the License.
 */

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
            $router->addRoute('GET', '/donate', 'donate');
            $router->addRoute('GET', '/suggest', 'suggest');
            $router->addRoute('POST', '/suggest', 'submitSuggest');
            $router->addRoute('GET', '/commands_botlist', 'commandsBotlist');
            $router->addRoute('GET', '/liveServerCount', 'liveServerCount');
            $router->addRoute('GET', '/flags', 'flags');
            $router->addRoute('GET', '/issuegenerator', 'issueGenerator');
        });
    }


    public function handle()
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = \strpos($uri, '?')) {
            $uri = \substr($uri, 0, $pos);
        }
        $uri = \rawurldecode($uri);

        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                \http_response_code(404);

                echo $this->blade->view('errors.404');
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//                $allowedMethods = $routeInfo[1];
                \http_response_code(405);
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
