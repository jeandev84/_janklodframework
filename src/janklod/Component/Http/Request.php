<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\ParameterBag;

/**
 * Class Request
 * @package Jan\Component\Http
*/
class Request
{

    public $queryParams;


    public $request;


    protected $method = 'GET';


    protected $requestUri;


    public function __construct()
    {
        $this->queryParams = new ParameterBag($_GET);
        $this->request = new ParameterBag($_POST);
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



    public function setMethod($method)
    {
        $this->method = $method;
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