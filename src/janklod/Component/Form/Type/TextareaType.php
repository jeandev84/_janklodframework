<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\Type;


/**
 * Class TextareaType
 * @package Jan\Component\Form\Type
*/
class TextareaType extends Type
{

    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        $attrs = $this->getVar('attr', []);
        $attributes = $this->makeAttributes($attrs);
        return sprintf('<textarea name="%s" %s></textarea>', $this->getChild(), $attributes);
    }
}