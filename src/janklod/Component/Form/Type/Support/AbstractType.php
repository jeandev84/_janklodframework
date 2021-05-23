<?php
namespace Jan\Component\Form\Type\Support;


use Jan\Component\Form\Resolver\OptionResolver;

/**
 * Class AbstractType
 * @package Jan\Component\Form\Type\Support
*/
abstract class AbstractType
{

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
          $this->child    = $child;
          $this->resolver = $resolver;
     }


     /**
      * @return string
     */
     public function getChild(): string
     {
         return $this->child;
     }



     /**
      * @return OptionResolver
     */
     public function getResolver(): OptionResolver
     {
         return $this->resolver;
     }



     /**
      * @return array
     */
     public function getOptions(): array
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
      * get name of form type
      *
      * @return string
     */
     abstract public function getName(): string;


     /**
      * build html input
      *
      * @return string
     */
     abstract  public function build(): string;
}