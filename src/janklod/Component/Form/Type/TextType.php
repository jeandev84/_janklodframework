<?php
namespace Jan\Component\Form\Type;


/**
 * Class TextType
 * @package Jan\Component\Form\Type
*/
class TextType extends InputType {

    /**
     * @return string
    */
    public function getName(): string
    {
        return 'text';
    }

}