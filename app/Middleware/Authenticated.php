<?php
namespace App\Middleware;


/**
 * Class Authenticated
 * @package App\Middleware
*/
class Authenticated
{
    public function __invoke($next)
    {
        echo 'Authenticated';
        return $next();
    }
}