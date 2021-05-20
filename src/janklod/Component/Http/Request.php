<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\InputBag;
use Jan\Component\Http\Bag\ParameterBag;
use Jan\Component\Http\Bag\ServerBag;


/**
 * Class Request
 *
 * @package Jan\Component\Http
*/
class Request
{

     /**
      * query params from super global variable $_GET
      *
      * @var InputBag
     */
     public $query;



     /**
      * server params from super global variable $_SERVER
      *
      * @var InputBag
     */
     public $request;



     /**
      * server params from super global variable $_SERVER
      *
      * @var ServerBag
     */
     public $server;




     /**
       * Request constructor.
       *
       * @param array $query
     */
     public function __construct(array $query = [])
     {
          $this->query = new InputBag($query);
     }



     /**
      * @return Request
     */
     public static function createFromGlobals(): Request
     {
          $request = new static($_GET);

          $request->query->set('search', 'foo');

          return $request;
     }
}