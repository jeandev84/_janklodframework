<?php
/*
|----------------------------------------------------------------------
|   Autoloader classes and dependencies of application
|----------------------------------------------------------------------
*/


use Jan\Component\Form\Type\EmailType;
use Jan\Component\Form\Type\PasswordType;
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

$form = new \Jan\Component\Form\Form();
$form->add('email', EmailType::class, [

])->add('password', PasswordType::class, [

])->add('username', TextType::class, [

]);

echo "<div>";
echo $form->createView();
echo "</div>";
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
