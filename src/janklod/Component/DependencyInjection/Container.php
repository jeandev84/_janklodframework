<?php
namespace Jan\Component\DependencyInjection;


use Jan\Component\DependencyInjection\Contract\ContainerInterface;

/**
 * Class Container
 * @package Jan\Component\DependencyInjection
*/
class Container implements ContainerInterface
{

    protected $bindings = [];



    public function bind($id, $concrete, $shared = false)
    {
          $this->bindings[$id] = $concrete;

          return $this;
    }


    public function has($id)
    {
         return \array_key_exists($id, $this->bindings);
    }


    /**
     * @param $id
     * @return array|mixed
    */
    public function get($id)
    {
        if(! $this->has($id)) {
             return $id;
        }

        return $this->resolve($id);
    }


    public function resolve($id, $parameters = [])
    {
        return [];
    }
}