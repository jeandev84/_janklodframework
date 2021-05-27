<?php
namespace Jan\Component\Form\Type\Support;


/**
 * Class FormStartType
 * @package Jan\Component\Form\Type\Support
*/
class FormStartType extends BaseType
{

    public function build(): string
    {
        return sprintf('<form %s>', $this->getAttributes());
    }
}