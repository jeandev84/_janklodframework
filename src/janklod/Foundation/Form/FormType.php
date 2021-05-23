<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Type\Resolver\OptionResolver;
use Jan\Contract\Form\FormBuilderInterface;

/**
 * Class FormType
 * @package Jan\Foundation\Form
*/
abstract class FormType
{
       public function build(FormBuilderInterface $builder, array $options)
       {

       }

       public function resolverOptions(OptionResolver $resolver)
       {
           $resolver->setDefaultOptions([

           ]);
       }
}