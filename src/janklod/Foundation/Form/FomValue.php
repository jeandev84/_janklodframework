<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Type\Support\Type;

/**
 * Class FomValue
 * @package Jan\Foundation\Form
*/
class FomValue
{

     /**
      * @var Type
     */
     protected $formType;


     /**
      * FomValue constructor.
      * @param Type $formType
     */
     public function __construct(Type $formType)
     {
         $this->formType = $formType;
     }


     /**
      * @throws \Exception
     */
     public function getValues()
     {
         return $this->formType->getOption('value');
     }
}