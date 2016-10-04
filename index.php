<?php
// Autoload file from composer.
require 'vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| All application routes are to be specified here,
| routing is done using fast-route library.
|
*/

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['App\Controllers\HomeController@index']);
    $route->addRoute('GET', '/tweets', ['App\Controllers\HomeController@tweets']);
});

$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);
switch ($routeInfo[0]) {
    // Dispatch only if found
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // Explode @ to get the method called in controller
        list($class, $method) = explode('@', $handler[0]);
        // New up the class and call the method specified.
        echo call_user_func_array([new $class, $method], $vars);
        break;
}
