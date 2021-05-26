<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\Type\Support\BaseType;
use Jan\Foundation\Form\Exception\FormViewException;


/**
 * Class FormView
 * @package Jan\Foundation\Form
*/
class FormView
{

    /**
     * @var string
    */
    protected $child;


    /**
     * @var BaseType
    */
    protected $typeObject;



    /**
     * @var OptionResolver
    */
    protected $resolver;


    /**
     * FormView constructor.
    */
    public function __construct(string $child, string $type, OptionResolver $resolver)
    {
        $this->child      = $child;
        $this->resolver   = $resolver;
        $this->typeObject  = $this->createNewType($child, $type, $resolver);
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
    */
    public function create()
    {
         return $this->typeObject->build();
    }



    public function getValue()
    {
         return '';
    }



    /**
     * @param string $child
     * @param string $type
     * @param OptionResolver $resolver
     * @return BaseType
    */
    protected function createNewType(string $child, string $type, OptionResolver $resolver): BaseType
    {
          return new $type($child, $resolver);
    }
}