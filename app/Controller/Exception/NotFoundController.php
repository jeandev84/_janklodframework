<?php
namespace App\Controller\Exception;


/**
 * Class NotFoundController
 * @package App\Controller\Exception
*/
class NotFoundController
{
     public function index($uri)
     {
          dd('Route with uri ('. $uri .') not found!');
     }
}