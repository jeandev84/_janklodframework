<?php
namespace Jan\Component\Container;


use Jan\Component\Container\Contract\ContainerAwareInterface;



/**
 * Class Container
 * @package Jan\Component\DependencyInjection
*/
class Container implements ContainerAwareInterface
{

        /**
         * @var array
        */
        protected $bindings = [];


        /**
         * @var array
        */
        protected $aliases  = [];



        /**
         * @var array
        */
        protected $resolved = [];




        /**
         * @param $abstract
         * @param $concrete
         * @param false $shared
         * @return $this
        */
        public function bind($abstract, $concrete = null, bool $shared = false): Container
        {
              if(\is_null($concrete)) {
                  $concrete = $abstract;
              }

              $this->bindings[$abstract] = compact('concrete', 'shared');

              return $this;
        }




        /**
         * @param $abstract
         * @param $concrete
         * @return $this
        */
        public function singleton($abstract, $concrete): Container
        {
            return $this->bind($abstract, $concrete, true);
        }



        /**
         * @param $abstract
         * @return $this
        */
        public function factory($abstract): Container
        {
             return $this->make($abstract);
        }




        /**
         * @param string $abstract
         * @param array $parameters
         * @return mixed|null
        */
        public function make(string $abstract, array $parameters = [])
        {
            return $this->resolve($abstract, $parameters);
        }



        /**
         * @param $id
         * @param $abstract
        */
        public function alias($id, $abstract)
        {
             $this->aliases[$id] = $abstract;
        }



        /**
         * @param $id
         * @param $abstract
         * @return mixed
        */
        public function getAlias($id, $abstract)
        {
             if(isset($this->aliases[$id])) {
                 return $this->aliases[$id];
             }

             return $abstract;
        }


        /**
         * @param $id
         * @return bool
        */
        public function has($id)
        {
            return \array_key_exists($id, $this->bindings);
        }




       /**
        * @param $id
        * @return array|mixed
        * @throws \Exception
       */
       public function get($id)
       {
            if(! $this->has($id)) {
                 return $id;
            }

            try {
                return $this->resolve($id);
            } catch (\Exception $e) {
                throw $e;
            }
        }




        /**
         * @param $id
         * @param array $parameters
         * @return mixed
        */
        public function resolve($id, array $parameters = [])
        {
            $abstract = $this->getAlias($id, $abstract);

            if(isset($this->bindings[$id])) {
                return $this->bindings[$id];
            }

            return null;
        }



        /**
         * @return array
        */
        public function getBindings()
        {
            return $this->bindings;
        }
}