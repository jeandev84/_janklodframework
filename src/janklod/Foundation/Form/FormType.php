<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Contract\Form\FormBuilderInterface;


/**
 * Class FormType
 * @package Jan\Foundation\Form
*/
abstract class FormType
{

       /**
        * @param FormBuilderInterface $builder
        * @param array $options
       */
       public function build(FormBuilderInterface $builder, array $options)
       {
            /*
            $builder->add('foo', null, [])
                    ->add('bar', null, [])
            ;
            */
       }


      /**
       * @param OptionResolver $resolver
      */
      public function configureOptions(OptionResolver $resolver)
      {
           $resolver->setDefaults([
               'data_class' => ''
           ]);
      }
}