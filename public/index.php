<?php
/*
|----------------------------------------------------------------------
|   Autoloader classes and dependencies of application
|----------------------------------------------------------------------
*/


use Jan\Component\Form\Type\EmailType;
use Jan\Component\Form\Type\PasswordType;
use Jan\Component\Form\Type\TextareaType;
use Jan\Component\Form\Type\TextType;

require_once __DIR__.'/../vendor/autoload.php';



/*
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';



/*
|-------------------------------------------------------
|    Check instance of Kernel
|-------------------------------------------------------
*/

/* $kernel = $app->get(Jan\Contract\Http\Kernel::class); */
$kernel = new \App\Http\Kernel();


/*
|-------------------------------------------------------
|    Get Response
|-------------------------------------------------------
*/


$response = $kernel->handle(
    $request = \Jan\Component\Http\Request::createFromGlobals()
);



/*
|-------------------------------------------------------
|    Send all headers to navigator
|-------------------------------------------------------
*/

$response->send();



/*
|-------------------------------------------------------
|    Terminate application
|-------------------------------------------------------
*/

$kernel->terminate($request, $response);

?>

<?php

$form = new \Jan\Foundation\Form\Form();

$form->add('email', EmailType::class, [
   'label' => 'Е-майл',
   'attr'  => [
      'placeholder' => 'Е-майл',
      'class' => 'form-control'
   ]
])->add('password', PasswordType::class, [
    'label' => 'Пароль',
    'attr'  => [
        'placeholder' => 'Пароль',
        'class' => 'form-control'
    ]
])->add('address', TextareaType::class, [
    'label' => 'Адрес',
    'attr'  => [
        'placeholder' => 'Адрес',
        'class' => 'form-control'
    ]
]);

dump($form->getVars());

require_once __DIR__.'/html/form.php';