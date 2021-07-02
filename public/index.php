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



$router = new \Jan\Component\Routing\Router();

$router->get('/', function () {
    return 'Hello World!';
}, 'home');

$router->get('/about', '\App\Controller\PageController@about');


dump($router->getRoutesByMethod());


$route = $router->match($_SERVER['REQUEST_METHOD'], $uri = $_SERVER['REQUEST_URI']);

if(! $route) {
    dd('Not found ( '. $uri . ' )');
}

dd($route);


echo "<h2>User1</h2>";

$em = new \Jan\Component\Database\Example\EntityManager();
$repo = new \Jan\Component\Database\Example\EntityRepository($em);

$user = $repo->findOne(1);
$user->setUsername('joe')
     ->setEmail('johndoe@ymail.com')
     ->setPassword('john123')
     ->setAddress('Golovynskoe shosse dom 8k 2a');


$em->flush();


echo "<h2>User 2</h2>";
$user = new \App\Entity\User();
$user->setEmail('jeanyao@ymail.com')
     ->setUsername('jeanyao123')
     ->setPassword('123')
;

/* $form = new \Jan\Foundation\Form\Form($user); */
$form = new \Jan\Foundation\Form\Form();
$form->config('data_class', \App\Entity\User::class);
$form->setData(new \App\Entity\User());


/* $form->start(); */
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
])->add('username', TextType::class, [
    'label' => 'Пользователькое имя',
    'attr'  => [
        'placeholder' => 'Пользователькое имя',
        'class' => 'form-control'
    ]
])->add('address', TextareaType::class, [
    'label' => 'Адрес',
    'attr'  => [
        'placeholder' => 'Адрес',
        'class' => 'form-control'
    ]
]);

/* $form->end(); */
/* $form->createView(); */
/* dump($form->getVars()); */
/*
dump($form->getData());
dump($form->getData('username'));
dump($form->getData('username')->getValues());
*/

dump($form);

$form->handleRequest($request);

if($form->isSubmit()) {
    $user = $form->getData();
    dump($user);
    $email = $form->getData('email');
    dump($email->getValues());
}

dump($form);

//require_once __DIR__.'/html/form.php';
require_once __DIR__.'/html/form_row.php';

?>

<?php

$connection = null;
$em = new \Jan\Foundation\ORM\Canon\EntityManager($connection);

// map all entities
$entities = [
    'App\\Entity\\User',
    'App\\Entity\\Region',
    'App\\Entity\\Post',
];

foreach ($entities as $entityClass) {
    $repositoryClass = str_replace('App\\Entity\\', 'App\\Repository\\', $entityClass);
    $repositoryClass .= 'Repository';
    $manager = new \Jan\Foundation\ORM\Canon\EntityManager();
    $repository = new $repositoryClass($manager);
    $em->setRepository($entityClass, $repository);
}




