<?php
namespace Jan\Component\Form\Type\Support;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\Traits\FormTrait;

/**
 * Class AbstractType
 * @package Jan\Component\Form\Type\Support
*/
abstract class Type
{

     use FormTrait;



     /**
      * @var string
     */
     protected $child;




     /**
      * @var OptionResolver
     */
     protected $resolver;



     /**
      * AbstractType constructor.
      * @param string $child
      * @param OptionResolver $resolver
     */
     public function __construct(string $child, OptionResolver $resolver)
     {
          $this->child = $child;
          $this->resolver = $resolver;
     }


     /**
      * @return OptionResolver
     */
     public function getOptionResolver(): OptionResolver
     {
         return $this->resolver;
     }


     /**
      * @return string
      * @throws \Exception
     */
     public function getAttributes()
     {
         $attrs = $this->getOption('attr', []);
         return $this->makeAttributes($attrs);
     }




     /**
      * @return string
      * @throws \Exception
     */
     public function getChild(): string
     {
         return $this->child;
     }



     /**
      * @return array
     */
     public function getVars(): array
     {
         return $this->resolver->getOptions();
     }


     /**
      * @param string $key
      * @param null $default
      * @return mixed
      * @throws \Exception
     */
     public function getOption(string $key, $default = null)
     {
         return $this->resolver->getOption($key, $default);
     }



    /**
     * @return string
    */
    public function getDefaultName(): string { }



    /**
     * @return string
    */
    abstract public function build(): string;
}