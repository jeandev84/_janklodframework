<?php
namespace Jan\Component\Form\Type;


/**
 * Class DateType
 * @package Jan\Component\Form\Type
*/
class DateType extends InputType
{
     /**
      * @return string
     */
     public function getName(): string
     {
         return 'date';
     }
}