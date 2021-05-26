<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\BaseType;


/**
 * Class ButtonType
 * @package Jan\Component\Form\Type
*/
class ButtonType extends BaseType
{

    /**
     * @return string
    */
    public function getTypeName()
    {
        return 'button';
    }


    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        return '<button type="' . $this->getTypeName() . '" name="' . $this->getChild() . '" ' . $this->getAttributes() . '>' . $this->getLabel() . '</button>';
    }
}