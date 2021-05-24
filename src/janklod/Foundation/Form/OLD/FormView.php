<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;

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
    protected $type;



    /**
     * @var OptionResolver
    */
    protected $resolver;


    /**
     * FormView constructor.
    */
    public function __construct(string $child, string $type, OptionResolver $resolver)
    {
         $this->child = $child;
         $this->type  = $type;
         $this->resolver = $resolver;
    }
}