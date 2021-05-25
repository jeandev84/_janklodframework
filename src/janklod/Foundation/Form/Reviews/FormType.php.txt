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
       abstract  public function build(FormBuilderInterface $builder, array $options);


      /**
       * @param OptionResolver $resolver
      */
      abstract  public function configureOptions(OptionResolver $resolver);
}