<?php
namespace Jan\Foundation\Routing;


use Jan\Component\Http\Request;
use Jan\Component\Http\Response;
use Jan\Component\Routing\Router;
use Jan\Foundation\Routing\Contract\RouteDispatcherInterface;



/**
 * Class RouteDispatcherEvent
 * @package Jan\Foundation\Routing
*/
class RouteDispatcher implements RouteDispatcherInterface
{

     // Just for the test
     protected $router;

     public function __construct()
     {
         $this->router = new Router();
     }


     public function dispatch(Request $request)
     {
         $this->router->get('/posts', 'PostController@list');
         $this->router->get('/post/{id}', 'PostController@show')
                      ->where('id', '\d+');

         $this->router->post('/post/new', 'PostController@create');
         $this->router->put('/post/{id}/edit', 'PostController@edit')
                      ->where('id', '\d+')
         ;

         $this->router->delete('/post/{id}', 'PostController@delete')
                      ->where('id', '\d+')
         ;

         $route = $this->router->match($request->getMethod(), $request->getRequestUri());

         if(! $route) {
             dd('Route not found.');
         }

         $target = $route['target'];

         if(! is_callable($target)) {
             if(\is_string($target) && stripos($target, '@') !== false) {
                 list($controller, $index) = explode('@', $target);
                 $controllerClass = 'App\\Controller\\'. $controller;
                 // TODO via dependency injection
                 $target = [new $controllerClass(), $index];
             }
         }

         $respond = call_user_func($target);

         if($respond instanceof Response) {
             return $respond;
         }

         if(\is_array($respond)) {
             return new Response(\json_encode($respond), 200, ['Content-Type' => 'application/json']);
         }

         if(\is_string($respond)) {
             return new Response($respond, 200, ['Content-Type' => 'text/html']);
         }

         return new Response(null, 200);
     }
}