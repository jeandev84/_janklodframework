<?php
namespace Jan\Component\Database;


/**
 * Class DatabaseManager
 * @package Jan\Component\Database
*/
class DatabaseManager
{

     protected $connections = [];

     public function __construct()
     {
         echo __METHOD__;
     }


     /**
      * @param $connection
     */
     public function addConnection($connection)
     {
          $this->connections[] = $connection;
     }
}