<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\AbstractType;


/**
 * Class InputType
 * @package Jan\Component\Form\Type
*/
class InputType extends AbstractType
{

    const MASK_FORMAT = '<input type="%s" name="%s" %s>';


    /**
     * @return string
    */
    public function getDefaultName(): string
    {

    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return 'text';
    }


    /**
     * @return string
    */
    public function build(): string
    {
        return $this->make($this->getName(), $this->getChild(), []);
    }


    /**
     * make input field
     *
     * @param string $name
     * @param string $child
     * @return string
     * @throws \Exception
    */
    protected function make(string $name, string $child): string
    {
        $attributes = implode(" ", $this->getOption('attr', []));
        return sprintf(static::MASK_FORMAT, $name, $child, $attributes);
    }
}