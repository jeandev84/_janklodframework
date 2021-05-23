<?php
namespace Jan\Component\Form\Resolver;


/**
 * Class DataResolver
 * @package Jan\Component\Form\Resolver
*/
class DataResolver
{

    /**
     * @var object|array
    */
    protected $data;


    /**
     * @var OptionResolver
    */
    protected $resolver;


    /**
     * DataResolver constructor.
     * @param $data
     * @param OptionResolver|null $resolver
     */
    public function __construct($data, OptionResolver $resolver = null)
    {
         $this->data = $data;
         $this->resolver = $resolver;
    }


    /**
     *
    */
    public function getValues()
    {

    }
}