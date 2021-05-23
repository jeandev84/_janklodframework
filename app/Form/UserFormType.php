<?php
namespace App\Form;


use App\Entity\User;
use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\Type\EmailType;
use Jan\Component\Form\Type\PasswordType;
use Jan\Component\Form\Type\TextareaType;
use Jan\Component\Form\Type\TextType;
use Jan\Contract\Form\FormBuilderInterface;
use Jan\Foundation\Form\FormType;


/**
 * Class UserFormType
 * @package App\Form
*/
class UserFormType extends FormType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
    */
    public function build(FormBuilderInterface $builder, array $options)
    {
          $builder->add('email', EmailType::class, [
              'label' => 'Емайл',
              'attr' => [
                  'class' => 'form-control',
                  'placeholder' => 'Е-майл'
                  /* 'style' => 'border: 1px solid #ccc;font-size:16;background-color:#ff2ad8' */
              ]
          ])->add('password', PasswordType::class, [
              'label' => 'Пароль',
              'attr' => [
                  'class' => 'form-control',
                  'placeholder' => 'Пароль'
                  /* 'style' => 'border: 1px solid #ccc;font-size:16;background-color:#ff2ad8' */
              ]
          ])->add('username', TextType::class, [
              'label' => 'Логин',
              'attr' => [
                  'class' => 'form-control',
                  'placeholder' => 'Логин'
                  /* 'style' => 'border: 1px solid #ccc;font-size:16;background-color:#ff2ad8' */
              ]
          ])->add('address', TextareaType::class, [
              'label' => 'Адрес',
              'attr' => [
                  'class' => 'form-control',
                  'placeholder' => 'Адрес'
              ]
          ]);;
    }


    /**
     * @param OptionResolver $resolver
    */
    public function configureOptions(OptionResolver $resolver)
    {
         $resolver->setDefaults([
             'data_class' => User::class
         ]);
    }
}