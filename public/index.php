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

echo getJsonContent();

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

echo "<h2>Sign up</h2>";
//$form->start('/', 'GET', []);
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

//$form->end();
dd($form);
?>

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
