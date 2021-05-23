<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\InputType;


/**
 * Class HiddenType
 * @package Jan\Component\Form\Type
*/
class HiddenType extends InputType
{
    public function getTypeName(): string
    {
        return 'hidden';
    }
}