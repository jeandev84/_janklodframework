<?php
namespace Jan\Component\Http\Bag;


/**
 * Class ParameterBag
 * @package Jan\Component\Http\Bag
*/
class ParameterBag
{
       /**
        * @var array
       */
       protected $params = [];


       /**
        * ParameterBag constructor.
        * @param array $params
       */
       public function __construct(array $params)
       {
             $this->params = $params;
       }


       /**
         * @param $key
         * @return bool
       */
       public function has($key)
       {
           return \array_key_exists($key, $this->params);
       }


       /**
        * @param $key
        * @param $value
       */
       public function set($key, $value)
       {
             $this->params[$key] = $value;
       }



       /**
        * @param $key
        * @param null $default
        * @return mixed|null
       */
       public function get($key, $default = null)
       {
            return $this->params[$key] ?? $default;
       }


       /**
        * @return array
       */
       public function all()
       {
           return $this->params;
       }
}