<?php
namespace Jan\Component\Database;


/**
 * Class ConnectionFactory
 * @package Jan\Component\Database
*/
class ConnectionFactory
{

     /**
      * @var Configuration
     */
     protected $config;


     /**
      * ConnectionFactory constructor.
      * @param Configuration $config
     */
     public function __construct(Configuration $config)
     {
         $this->config = $config;
     }


     /**
      * @param $driver
      * @return string
     */
     public function make($driver)
     {

     }


     public function getPDO()
     {

     }


     public function getMySQL()
     {

     }
}