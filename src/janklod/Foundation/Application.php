<?php
namespace Jan\Foundation;


use Jan\Component\Container\Container;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;



/**
 * Class Application
 * @package Jan\Foundation
*/
class Application extends Container
{

     /**
      * name of application
      *
      * @var string
     */
     protected $name = 'JanFramework';


     /**
      * version of application
      *
      * @var string
     */
     protected $version = '1.0';




     /**
      * base path of application
      *
      * @var string
     */
     protected $basePath;



     /**
      * Application constructor.
      * @param string $basePath
     */
     public function __construct(string $basePath = '')
     {
           if($basePath) {
               $this->setBasePath($basePath);
           }
     }


     /**
      * set base path of application
      *
      * @param $basePath
      * @return $this
     */
     public function setBasePath($basePath): Application
     {
          $this->basePath = rtrim($basePath, '\\/');

          return $this;
     }


     /**
      * get base path of application
      *
      * @return string
     */
     public function getBasePath()
     {
         return $this->basePath;
     }


     /**
      * @param string $version
      * @return $this
     */
     public function setVersion(string $version): Application
     {
          $this->version = $version;

          return $this;
     }


     /**
       * @return string
     */
     public function getVersion()
     {
         return $this->version;
     }



     /**
       * @param Request $request
       * @param Response $response
     */
     public function terminate(Request $request, Response $response)
     {
           // ...
     }
}