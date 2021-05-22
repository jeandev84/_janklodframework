<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Parser\UrlParser;


/**
 * Class Uri
 * @package Jan\Component\Http
*/
class Url
{


     /**
      * @var string
     */
     protected $scheme;


      /**
       * @var mixed
      */
      protected $user;


      /**
       * @var mixed
      */
      protected $password;


      /**
       * @var string
      */
      protected $host;



     /**
      * @var string
     */
     protected $port;



     /**
      * @var string
     */
     protected $path;



     /**
      * @var string
     */
     protected $queryString;


     /**
      * @var mixed
     */
     protected $fragment;



     /**
      * Uri constructor.
      * @param string $url
     */
     public function __construct(string $url)
     {
          $parser            =  new UrlParser($url);
          $this->scheme      =  $parser->parse(PHP_URL_SCHEME);
          $this->user        =  $parser->parse(PHP_URL_USER);
          $this->password    =  $parser->parse(PHP_URL_PASS);
          $this->host        =  $parser->parse(PHP_URL_HOST);
          $this->port        =  $parser->parse(PHP_URL_PORT);
          $this->path        =  $parser->parse(PHP_URL_PATH);
          $this->queryString =  $parser->parse(PHP_URL_QUERY);
          $this->fragment    =  $parser->parse(PHP_URL_FRAGMENT);
     }



     /**
      * @return mixed
     */
     public function getScheme()
     {
         return $this->scheme;
     }


    /**
     * @return mixed
    */
    public function getHost()
    {
        return $this->host;
    }



    /**
      * @return mixed
    */
    public function getPort()
    {
         return $this->port;
    }


    /**
      * @return mixed
    */
    public function getPath()
    {
         return $this->path;
    }


    /**
     * @return mixed
    */
    public function getQueryString()
    {
        return $this->queryString;
    }


    /**
     * @return mixed
    */
    public function getFragment()
    {
        return $this->fragment;
    }



    /**
     * @return mixed
    */
    public function getUser()
    {
        return $this->user;
    }



    /**
      * @return mixed
    */
    public function getPassword()
    {
        return $this->password;
    }
}