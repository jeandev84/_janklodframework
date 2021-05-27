<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Foundation\Form\Contract\FormBuilderInterface;



/**
 * Class FormType
 * @package Jan\Foundation\Form
*/
abstract class FormType
{

        /**
         * @var array
        */
        protected $options = [];


        public function __construct()
        {
        }




       /**
        * @param OptionResolver $resolver
       */
       public function configureOptions(OptionResolver $resolver)
       {
           $resolver->setOptions([

           ]);
       }
}