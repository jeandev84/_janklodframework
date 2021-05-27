<?php
namespace Jan\Foundation\Routing;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\Router;
use Jan\Foundation\Form\Form;
use Jan\Foundation\Form\FormType;

/**
 * Class Controller
 * @package Jan\Foundation\Routing
*/
class Controller
{

      /**
       * @param string $type
       * @param $data
       * @param array $options
       * @throws \Exception
      */
      public function createForm(string $type, $data = null, array $options = [])
      {
           $router = new Router();

           // just for example
           $options = [
               'method' => 'POST',
               'path'   => $router->generate('contact', ['slug' => 'contact-us'])
           ];

           /** @var FormType $formType */
           $builder = new $type();

           $form = new Form($data);
           $resolver = new OptionResolver();
           $form->setVars($options);

           $builder->configureOptions($resolver);
           $builder->build($form, $options);

           return $form;
      }
}