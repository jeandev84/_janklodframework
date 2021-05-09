<?php

require_once __DIR__.'/../vendor/autoload.php';

use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteCollection;

$route1 = new Route();
$route1->setPath('/');
$route1->setMethods('GET');

$route2 = new Route();
$route2->setPath('/contact');
$route2->setMethods('POST');

$route3 = new Route();
$route3->setPath('/foo');
$route3->setMethods('GET');

$routeCollection = new RouteCollection();

$routeCollection->add($route1)->setTarget('HomeController@index');
$routeCollection->add($route2)->setTarget('HomeController@contact');
$routeCollection->add($route3)->setTarget(function () {
    return "Hello";
});

dump($routeCollection->getRoutes());
