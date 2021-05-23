<?php
namespace Jan\Component\Form;


/**
 * Class FormBag
 *
 * @package Jan\Component\Form
 */
class FormBag
{
    /**
     * @var array
   */
    protected $items = [];


    /**
     * ParamResolver constructor.
     * @param array $items
    */
    public function __construct(array $items)
    {
        $this->items = $items;
    }


    /**
     * @param $key
     * @param null $default
     * @return mixed|null
    */
    public function get($key, $default = null)
    {
         return $this->items[$key] ?? $default;
    }
}