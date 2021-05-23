<?php
namespace Jan\Component\Form\Resolver;


/**
 * Class OptionResolver
 * @package Jan\Component\Form\Resolver
*/
class OptionResolver
{

      /**
       * @var array
      */
      protected $options = [];



      /**
        * OptionResolver constructor.
        * @param array $options
      */
      public function __construct(array $options = [])
      {
           $this->options = $options;
      }



      /**
       * @param array $options
      */
      public function setDefaultOptions(array $options = [])
      {
           $this->options = array_merge($options, $this->options);
      }



     /**
      * @param string $key
      * @param null $default
      * @return mixed
      * @throws \Exception
     */
     public function getOption(string $key, $default = null)
     {
        if(\array_key_exists($key, $this->options)) {
            throw new \Exception($key .' is not a valid option param.');
        }

        return $this->options[$key] ?? $default;
     }


     /**
       * @return array
     */
     public function getOptions(): array
     {
           return $this->options;
     }
}