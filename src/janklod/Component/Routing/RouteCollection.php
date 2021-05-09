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
      * @param Route $route
     */
     public function addGroup(Route $route)
     {
          $this->groups[] = $this->add($route);
     }


     /**
      * @param Route $route
     */
     public function addResource(Route $route)
     {
         $this->resources[] = $this->add($route);
     }


     /**
      * @return array
     */
     public function getNamedRoutes(): array
     {
          foreach ($this->getRoutes() as $route)
          {
               if($name = $route->getName())
               {
                   $this->namedRoutes[$name] = $route;
               }
          }

          return $this->namedRoutes;
     }



    /**
     * @return array
    */
    public function getRoutesByMethod(): array
    {
        $routes = [];

        foreach ($this->getRoutes() as $route)
        {
            /** @var Route $route */
            $routes[$route->getMethodsToString()][] = $route;
        }

        return $routes;
    }
    
    

     /**
      * @param string $name
      * @param array $params
      * @return false|string
     */
     public function generate(string $name, array $params = []): bool|string
     {
            if(! $this->has($name)) {
                return false;
            }

            /** @var Route $route */
            $route = $this->namedRoutes[$name];

            return $route->convertParams($params);
     }



     /**
      * @param $name
      * @return bool
     */
     public function has($name): bool
     {
         return \array_key_exists($name, $this->getNamedRoutes());
     }
}