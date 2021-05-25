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
          'label'       => '',
          'attr'        => [],
          'mapped'      => true,
          'data'        => null,
          'constraints' => [],
          'multiple'    => false,
          'parent'      => null,
          'values'      => []
      ];



      /**
        * OptionResolver constructor.
        * @param array $options
      */
      public function __construct(array $options = [])
      {
           $this->add($options);
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
      public function setOptions(array $options)
      {
          $this->options = array_merge($this->options, $options);
      }


      /**
       * @param array $options
      */
      public function add(array $options)
      {
          foreach ($options as $key => $value) {
              $this->setOption($key, $value);
          }
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