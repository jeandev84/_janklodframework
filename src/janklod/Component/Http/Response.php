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



    protected $messages = [
       200 => 'OK',
       201 => 'Created',
       301 => 'Redirect permanently',
       404 => 'Not found'
    ];

    /**
     * Response constructor.
     * @param null $content
     * @param int $status
     * @param array $headers
    */
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


    public function getStatus()
    {
        return $this->status;
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


    /**
     * @return array
    */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param $content
     * @return $this
   */
    public function setContent($content)
    {
        $this->content = $content;

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
             // dd('OK');
        }

        $this->sendHeaders();
        $this->sendStatusMessage();
    }


    /**
     * @return $this
    */
    public function sendStatusMessage()
    {
         // http_response_code($this->getStatus());
         header('HTTP/1.0 '. $this->getStatus() . ' '. $this->messages[$this->status] ?? '');
         return $this;
    }


    /**
     * @return $this
    */
    public function sendHeaders()
    {
        foreach ($this->headers as $key => $value) {
             header($key .' : '. $value);
        }

        return $this;
    }


    /**
     * @return void
    */
    public function sendBody()
    {
        echo $this->getContent();
    }
}