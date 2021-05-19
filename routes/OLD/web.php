<?php

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

use Jan\Component\Routing\Router;

$router = new Router();

$router->get('/', 'PageController@index', 'home');

$router->get('/about', 'PageController@about');
$router->get('/contact', 'PageController@contact', 'contact.form');
$router->post('/contact', 'PageController@contact', 'contact.send');

$router->get('/foo', function () {
    return 'Foo!';
}, 'foo');


$router->get('/posts', 'PostController@index', 'post.list');
$router->get('/post/{id}', 'PostController@show')
    ->where('id', '\d+')
    ->name('post.show')
;

$router->map('GET|POST','/auth/login', 'Auth\\LoginController@index')
    ->name('auth.login')
    ->middleware(\App\Middleware\Authenticated::class);

/* dump($router->getRoutes()); */
/* dump($router->getRoutesByMethod()); */

dump($router->getNamedRoutes());