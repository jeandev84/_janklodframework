<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\ParameterBag;

/**
 * Class Request
 * @package Jan\Component\Http
*/
class Request
{

     /**
      * query params from GET request
      *
      * @var array
     */
     public $queryParams;



     /**
       * Request constructor.
       * @param array $queryParams
     */
     public function __construct(array $queryParams = [])
     {
          $this->queryParams = new ParameterBag($queryParams);
     }



     /**
      * @return static
     */
     public static function createFromGlobals(): static
     {
          $request = new static($_GET);

          $request->queryParams->set('search', 'foo');

          return $request;
     }
}