<?php
namespace Jan\Component\Container;


/**
 * Class Container
 * @package Jan\Component\Container
*/
class Container
{

      /**
       * @var array
      */
      protected $bindings = [];


      /**
        * @param $id
        * @param $value
        * @return $this
      */
      public function bind($id, $value)
      {
          $this->bindings[$id] = $value;

          return $this;
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
       * @return mixed|null
      */
      public function get($id)
      {
          if(! $this->has($id)) {
              return null;
          }

          return $this->bindings[$id];
      }


      /**
        * @return array
       */
      public function getBindings()
      {
          return $this->bindings;
      }
}