<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Type\Support\BaseType;


/**
 * Class FomValue
 * @package Jan\Foundation\Form
*/
class FomValue
{

     /**
      * @var FormView
     */
     protected $formView;



     /**
      * FomValue constructor.
      * @param FormView $formView
     */
     public function __construct(FormView $formView)
     {
         $this->formView = $formView;
     }


     /**
      * @throws \Exception
     */
     public function getValues()
     {
         return $this->formView->getValue();
     }
}