<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\InputType;



/**
 * Class DatetimeType
 * @package Jan\Component\Form\Type
*/
class DatetimeType extends InputType
{

    public function getTypeName(): string
    {
        return 'datetime';
    }
}