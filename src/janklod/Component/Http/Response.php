<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\HeaderBag;
use Jan\Component\Http\Contract\ResponseInterface;

/**
 * Class Response
 * @package Jan\Component\Http
*/
class Response implements ResponseInterface
{

     use StatusCode;


     /**
       * @var string
      */
      protected $protocol = 'HTTP/1.0';


      /**
       * @var string
      */
      protected $content;


      /**
        * @var int
      */
      protected $status;



      /**
        * @var HeaderBag
      */
      public $headers;



      /**
       * Response constructor.
       *
       * @param string|null $content
       * @param int $status
       * @param array $headers
      */
      public function __construct(string $content = null, int $status = 200, array $headers = [])
      {
           $this->setContent($content);
           $this->setStatus($status);
           $this->headers = new HeaderBag($headers);
      }


      /**
       * set http protocol version
       *
       * @param $protocol
      */
      public function setProtocol($protocol)
      {
           $this->protocol = $protocol;
      }


      /**
       * get protocol version
       *
       * @return string
      */
      public function getProtocol(): string
      {
          return $this->protocol;
      }



      /**
       * set response content
       *
       * @param $content
      */
      public function setContent($content)
      {
           $this->content = $content;
      }


      /**
       * get response content
       *
       * @return string|null
      */
      public function getContent()
      {
          return $this->content;
      }



      /**
       * set response code status
       *
       * @param int $status
      */
      public function setStatus(int $status)
      {
           $this->status = $status;
      }



      /**
       * get response code status
       *
       * @return int
      */
      public function getStatus()
      {
          return $this->status;
      }



      /**
       * set response header
       *
       * @param $key
       * @param $value
      */
      public function setHeader($key, $value = null)
      {
          $this->headers->set($key, $value);
      }



      /**
       * Get response headers
       *
       * @return array
      */
      public function getHeaders(): array
      {
          return $this->headers->all();
      }



      /**
       * @param $headers
       * @return Response
      */
      public function withHeaders($headers): Response
      {
          $this->headers->merge($headers);

          return $this;
      }




      /**
       * @param int $status
       * @return $this
      */
      public function withStatus($status): Response
      {
          $this->setStatus($status);

          return $this;
      }



      /**
       * @param $content
       * @return $this
      */
      public function withBody($content): Response
      {
         $this->setContent($content);

         return $this;
      }



      /**
       * @param $version
       * @return $this
      */
      public function withProtocol($version): Response
      {
          $this->setProtocol($version);

         return $this;
      }


      /**
       * @param array $data
       * @return Response
      */
      public function toJson(array $data): Response
      {
           $this->setHeader('Content-Type', 'application/json');
           return $this->withBody(\json_encode($data));
      }


      /**
       * send response headers
       *
       * @return void
      */
      public function sendHeaders()
      {
          foreach ($this->headers->all() as $key => $value) {
              header($key .' : ' . $value);
          }
      }


      /**
       * send response body
       *
       * @return void
      */
      public function sendBody()
      {
          echo $this->getContent();
      }


      /**
       * send status message of response
       *
       * @return void
      */
      public function sendStatusMessage()
      {
         // TODO implements
      }


      /**
       * send all information to the server
       *
       * @return void
      */
      public function send()
      {
         // TODO implements
      }


      /**
       * @return string
      */
      public function __toString()
      {
           return (string) $this->getContent();
      }
}