<?php
namespace Jan\Component\Routing;


/**
 * Class RouteCollection
 * @package Jan\Component\Routing
*/
class RouteCollection
{

     /**
      * @var array
     */
     protected $routes = [];


     /**
      * @param Route $route
     */
     public function add(Route $route)
     {
         $this->routes[] = $route;
     }


     /**
      * @return array
     */
     public function getRoutes()
     {
         return $this->routes;
     }
}