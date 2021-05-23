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
      protected $options = [
          'parent'     => null,
          'rows'       => [],
          'multiple'   => false,
          'mapped'     => false,
          'html'       => [],
          'data_class' => null,
          'data'       => null
      ];



      /**
        * OptionResolver constructor.
        * @param array $options
      */
      public function __construct(array $options = [])
      {
           $this->options = $options;
      }


      /**
       * @param $key
       * @param $value
       * @return $this
      */
      public function setOption($key, $value): OptionResolver
      {
          $this->options[$key] = $value;

          return $this;
      }


      /**
       * @param array $options
      */
      public function addOptions(array $options)
      {
          $this->options = array_merge($this->options, $options);
      }



      /**
       * @param array $options
      */
      public function setDefaults(array $options = [])
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