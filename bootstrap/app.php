<?php
/*
|-------------------------------------------------------------------
|    Create new application
|-------------------------------------------------------------------
*/

$app = new \Jan\Foundation\Application(
    realpath(__DIR__.'/../')
);


/*
|-------------------------------------------------------------------
|    Binds important interfaces of application
|-------------------------------------------------------------------
*/

$app->bind(
    \Jan\Contract\Http\Kernel::class,
    \App\Http\Kernel::class
);


// DEMO
$app->bind('name', 'Жан-Клод');

$app->bind('foo', function () {
    return 'Foo';
});

$app->bind(\App\Controller\PageController::class, new \App\Controller\PageController());


/*
|-------------------------------------------------------------------
|    Return instance of application
|-------------------------------------------------------------------
*/
return $app;