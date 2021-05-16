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
     protected $groups = [];


     /**
      * @var array
     */
     protected $resources = [];



     /**
      * @param Route $route
      * @return Route
     */
     public function add(Route $route)
     {
         $this->routes[] = $route;

         return $route;
     }


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
      * @param array $groups
      * @return RouteCollection
     */
     public function addGroup(array $groups)
     {
          foreach ($groups as $route) {
              $this->add($route);
          }

          $this->groups[] = $groups;

          return $this;
     }


     /**
      * get resources
      *
      * @return array
     */
     public function getGroups()
     {
         return $this->groups;
     }



     /**
      * add resources
      *
      * @param array $resources
      * @return RouteCollection
     */
     public function addResource(array $resources)
     {
         foreach ($resources as $route) {
             $this->add($route);
         }

         $this->resources[] = $resources;

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
          $namedRoutes = [];
          foreach ($this->getRoutes() as $route) {
               if($name = $route->getName()) {
                   $namedRoutes[$name] = $route;
               }
          }
          return $namedRoutes;
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