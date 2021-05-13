<?php
namespace Jan\Component\Http;


/**
 * Class Response
 * @package Jan\Component\Http
*/
class Response
{

    protected $status;

    protected $content;

    protected $headers = [];

    public function __construct($content = null, $status = 200, $headers = [])
    {
         $this->content = $content;
         $this->status  = $status;
         $this->headers = $headers;
    }


    /**
     * @param $headers
     * @return $this
    */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }


    public function getContent()
    {
        return $this->content;
    }
}