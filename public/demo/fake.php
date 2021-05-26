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


dump($app->getBindings());

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


// $url = "http://dppo.apkpro.ru";

/*
function getJsonContent()
{
    $content = file_get_contents("php://input");
    $items = explode("&", $content);
    $arr = [];

    foreach ($items as $item) {
        if(stripos($item, "=") !== false) {
            list($key, $value) = explode("=", $item);
            $arr[$key] = urldecode($value);
        }
    }

    return \json_encode($arr);
}

echo getJsonContent() . "<br>";
*/


// set parsed body
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = file_get_contents('php://input');
    /* echo urldecode($content); */
    parse_str(urldecode($content), $output);
    dump($output);

    // dump(\json_encode($output));

    $user = new stdClass(); // \json_encode($output);
    $user->email    = $output['email'];
    $user->password = $output['password'];
    $user->username = $output['username'];
    $user->address  = $output['address'];

    $j = json_encode($user);

    unset($output['_method']);

    $std = new stdClass();
    foreach ($output as $key => $value) {
        $std->{$key} = $value;
    }

    dump($std);
}


$user = new \App\Entity\User();
$form = new \Jan\Foundation\Form\Form($user);
$form->add('email', EmailType::class, [
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
]);

//echo "<div>";
//echo $form->createView();
//echo "</div>";

/*
echo "<h2>Sign up</h2>";
//$form->start('/', 'POST', []);
echo '<form action="/" method="GET">';
echo '<div class="form-group">';
echo $form->createRow('email');
echo '</div>';

echo '<div class="form-group">';
echo $form->createRow('password');
echo '</div>';

echo '<div class="form-group">';
echo $form->createRow('username');
echo '</div>';

echo '<div class="form-group">';
echo $form->createRow('address');
echo '</div>';
echo '</form>';

$form->end();
dump($form);
*/

// Before submit
dump($form);

$form->handleRequest($request);

// After submit
dump($form);

if($form->isSubmit() && $form->isValid()) {
    $user = $form->getData();
    dump($user);
    // persist data to the database
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link rel="stylesheet" href="/assets/bootstrap/bootstrap.min.css">
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    -->
</head>
<body>
<form action="/" method="POST" enctype="">
      <h2 class="text-center">Sign up</h2>
      <div class="container">
          <div class="form-group">
              <?= $form->createRow('email'); ?>
          </div>

          <div class="form-group">
              <?= $form->createRow('password'); ?>
          </div>

          <div class="form-group">
              <?= $form->createRow('username'); ?>
          </div>

          <div class="form-group">
              <?= $form->createRow('address'); ?>
          </div>
          <input type="hidden" name="_method" value="PUT">
          <button type="submit" class="btn btn-primary">Отправить</button>
      </div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<!--
<form action="" method="get">
    <div>
        <input type="text" name="email" placeholder="Email">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <button type="submit">Send</button>
    </div>
</form>
-->