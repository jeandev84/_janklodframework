<?php

use Jan\Component\Routing\Route;

require_once __DIR__.'/../vendor/autoload.php';


/*
use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteCollection;

$route1 = new Route();
$route1->setPath('/');
$route1->setMethods('GET');

$route2 = new Route();
$route2->setPath('/contact');
$route2->setMethods('POST');

$route3 = new Route();
$route3->setPath('/foo');
$route3->setMethods('GET');

$routeCollection = new RouteCollection();

$routeCollection->add($route1)->setTarget('HomeController@index');
$routeCollection->add($route2)->setTarget('HomeController@contact');
$routeCollection->add($route3)->setTarget(function () {
    return "Hello";
});

dump($routeCollection->getRoutes());
*/

echo "<h2>Routing</h2>";
$router = new \Jan\Component\Routing\Router();

$router->get('/', 'HomeController@index')
       ->middleware(\App\Middleware\Authenticated::class)
;

$router->get('/about', 'HomeController@about');
$router->get('/contact', 'HomeController@contact');
$router->post('/contact', 'HomeController@contact');

$router->get('/foo', function () {
   return 'Foo!';
});

$router->get('/post/{id}', 'PostController@show')
       ->where('id', '\d+')
;

dump($router->getRoutes());


$request = \Jan\Component\Http\Request::createFromGlobals();

/** @var Route $route */
/* $route = $router->match($_SERVER['REQUEST_METHOD'], $uri = $_SERVER['REQUEST_URI']); */
$route = $router->match($request->getMethod(), $uri = $request->getRequestUri());


if(! $route) {
    dd('Route : '. $uri . ' not found!');
}


/* dump($route['middleware']); */
dump($route);


echo "<h2>Container</h2>";


$container = new \Jan\Component\Container\Container();
$container->bind('request', new \Jan\Component\Http\Request());
$container->bind('db', new \Jan\Component\Database\DatabaseManager());


dump($container->getBindings());


echo '<h2>Request</h2>';

$request = new \Jan\Component\Http\Request();

dd($request);