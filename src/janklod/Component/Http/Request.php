<?php
namespace Jan\Component\Http;


/**
 * Class Request
 * @package Jan\Component\Http
*/
class Request
{

    protected $method = 'GET';


    protected $requestUri;


    public function __construct()
    {
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