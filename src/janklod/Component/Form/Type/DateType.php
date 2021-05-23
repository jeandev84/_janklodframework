<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\InputType;


/**
 * Class DateType
 * @package Jan\Component\Form\Type
*/
class DateType extends InputType
{
     /**
      * @return string
     */
     public function getTypeName(): string
     {
         return 'date';
     }
}