<?php
/**
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org>
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
            $router->addRoute('GET', '/suggest', 'suggest');
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
