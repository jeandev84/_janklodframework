<?php
namespace Jan\Component\Form\Type;


/**
 * Class HiddenType
 * @package Jan\Component\Form\Type
*/
class HiddenType extends InputType
{
    public function getName(): string
    {
        return 'hidden';
    }
}