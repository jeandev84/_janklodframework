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
     * @param $status
     * @return $this
    */
    public function setStatus($status)
    {
         $this->status = $status;

         return $this;
    }


    /**
     * @param $headers
     * @return $this
    */
    public function setHeaders($headers)
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }


    public function getContent()
    {
        return $this->content;
    }


    /**
     * @return $this
    */
    public function send()
    {
        if(\headers_sent()) {
           return $this;
        }

        if(\php_sapi_name() != 'cli') {
            $this->sendStatusMessage();
            $this->sendHeaders();
        }
    }


    /**
     * @return $this
    */
    public function sendStatusMessage()
    {
         http_response_code($this->status);

         return $this;
    }


    /**
     * @return void
    */
    public function sendHeaders()
    {
        foreach ($this->headers as $key => $value) {
             header($key .' : '. $value);
        }
    }


    /**
     * @return void
    */
    public function sendBody()
    {
        echo $this->getContent();
    }
}