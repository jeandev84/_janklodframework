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
     * @var string
    */
    protected $typeClass;




    /**
     * @var OptionResolver
    */
    protected $resolver;


    /**
     * FormView constructor.
    */
    public function __construct(string $child, string $type, OptionResolver $resolver)
    {
        $this->child       = $child;
        $this->resolver    = $resolver;
        $this->typeClass   = $type;
    }


    /**
     * @return string
    */
    public function getChild(): string
    {
        return $this->child;
    }


    /**
     * @return string
    */
    public function getTypeClass(): string
    {
        return $this->typeClass;
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
         $inputObject = $this->createNewType($this->typeClass, $this->child, $this->resolver);
         return $inputObject->build();
    }



    public function getValue()
    {
         return '';
    }



    /**
     * @param string $type
     * @param string $child
     * @param OptionResolver $resolver
     * @return BaseType
    */
    protected function createNewType(string $type, string $child, OptionResolver $resolver): BaseType
    {
          return new $type($child, $resolver);
    }
}