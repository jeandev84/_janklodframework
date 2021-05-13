<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\ParameterBag;

/**
 * Class Request
 * @package Jan\Component\Http
*/
class Request
{

    public $query;


    protected $method = 'GET';


    protected $requestUri;


    public function __construct()
    {
        $this->query = new ParameterBag($_GET);
    }



    /**
     * @return static
    */
    public static function createFromGlobals()
    {
        $request = new static();
        $request->method = $_SERVER['REQUEST_METHOD'];
        $request->requestUri = $_SERVER['REQUEST_URI'];

        return $request;
    }


    public function getMethod()
    {
        return $this->method;
    }


    public function getRequestUri()
    {
        return $this->requestUri;
    }
}