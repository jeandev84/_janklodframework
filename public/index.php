<?php

use Jan\Component\Routing\Route;
use Jan\Component\Templating\Renderer;

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

$router = new \Jan\Component\Routing\Router();

$router->get('/', 'PageController@index');

$router->get('/about', 'PageController@about');
$router->get('/contact', 'PageController@contact');
$router->post('/contact', 'PageController@contact');

$router->get('/foo', function () {
   return 'Foo!';
});


$router->get('/posts', 'PostController@index');
$router->get('/post/{id}', 'PostController@show')
       ->where('id', '\d+');

$router->map('GET|POST','/auth/login', 'Auth\\LoginController@index')
       ->middleware(\App\Middleware\Authenticated::class);

/* dump($router->getRoutes()); */
/* dump($router->getRoutesByMethod()); */


$request = \Jan\Component\Http\Request::createFromGlobals();

/** @var Route $route */
/* $route = $router->match($_SERVER['REQUEST_METHOD'], $uri = $_SERVER['REQUEST_URI']); */
$route = $router->match($request->getMethod(), $uri = $request->getRequestUri());


if(! $route) {
    call_user_func_array('App\\Controller\\Exception\NotFoundController::index', [$uri]);
    exit;
}


/* dump($route['middleware']); */
/* dump($route); */

if(is_string($route['target'])) {
    list($controllerClassName, $action) = explode('@', $route['target']);
    $controllerClass = 'App\\Controller\\'. $controllerClassName;

    $view = new Renderer(__DIR__.'/../views');
    $controller = new $controllerClass($view);
    $content = call_user_func_array([$controller, $action], $route['matches']);
    $response = new \Jan\Component\Http\Response($content);
    $response->sendBody();
}


/*
echo "<h2>Container</h2>";


$container = new \Jan\Component\Container\Container();
$container->bind('request', new \Jan\Component\Http\Request());
$container->bind('db', new \Jan\Component\Database\DatabaseManager());


dump($container->getBindings());

echo '<h2>Request</h2>';
dump($request);

dump($request->query->replace([
    'Email' => 'johndoe@gmail.com',
    'Username' => 'johndoe',
    'City' => 'Kurgan'
]));

dump($request->query->all());


echo '<h2>Templating</h2>';

$view = new \Jan\Component\Templating\Renderer(__DIR__.'/../views');

$content = $view->render('auth/login.php', [
    'username' => 'john',
    'email'    => 'johndoe@gmail.com'
]);

$response = new \Jan\Component\Http\Response($content);
echo $response->getContent();
*/