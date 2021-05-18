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
      * @var array
     */
     protected $group = [];


     /**
      * @var array
     */
     protected $resources = [];



     /**
      * @var array
     */
     protected $namedRoutes = [];



     /**
      * @param Route $route
      * @return Route
     */
     public function add(Route $route)
     {
         $this->routes[] = $route;

         return $route;
     }


//     /**
//      * @param $name
//      * @param Route $route
//      * @throws \Exception
//     */
//     public function set($name, Route $route)
//     {
//          if(\array_key_exists($name, $this->namedRoutes)) {
//               throw new \Exception('name '. $name .' already taken!');
//          }
//
//          $this->namedRoutes[$name] = $route;
//     }



     /**
      * @return Route[]
     */
     public function getRoutes()
     {
         return $this->routes;
     }


     /**
      * @param array $routes
     */
     public function setRoutes(array $routes)
     {
         foreach ($routes as $route) {
              if($route instanceof Route) {
                  $this->add($route);
              }
         }
     }


     /**
      * @param array $group
      * @return RouteCollection
     */
     public function addRouteGroup(array $group)
     {
          $this->setRoutes($group);

          $this->group = array_merge($this->group, $group);

          return $this;
     }


     /**
      * get resources
      *
      * @return array
     */
     public function getRouteGroups()
     {
         return $this->group;
     }



     /**
      * add resources
      *
      * @param array $routes
      * @return RouteCollection
     */
     public function addRouteResource(array $routes)
     {
         $this->setRoutes($routes);

         $this->resources = array_merge($this->resources, $routes);

         return $this;
     }


     /**
      * get resources
      *
      * @return array
     */
     public function getResources()
     {
         return $this->resources;
     }


     /**
      * get named routes
      *
      * @return array
     */
     public function getNamedRoutes(): array
     {
          foreach ($this->getRoutes() as $route) {
              if($name = $route->getName()) {
                  $this->namedRoutes[$name] = $route;
              }
          }

          return $this->namedRoutes;
     }


    /**
     * @param $name
     * @return bool
    */
    public function has($name): bool
    {
         return \array_key_exists($name, $this->getNamedRoutes());
    }



     /**
      * @param $routeName
      * @return Route
     */
     public function getRoute($routeName): Route
     {
         return $this->getNamedRoutes()[$routeName];
     }



    /**
     * get routes by method
     *
     * @return array
    */
    public function getRoutesByMethod(): array
    {
        $routes = [];

        foreach ($this->getRoutes() as $route)
        {
            /** @var Route $route */
            $routes[$route->getMethodToString()][] = $route;
        }

        return $routes;
    }
}