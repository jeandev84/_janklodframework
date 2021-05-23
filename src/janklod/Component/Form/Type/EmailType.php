<?php
namespace Jan\Component\Form\Type;


/**
 * Class EmailType
 * @package Jan\Component\Form\Type
*/
class EmailType extends InputType
{
     public function getName(): string
     {
         return 'email';
     }
}