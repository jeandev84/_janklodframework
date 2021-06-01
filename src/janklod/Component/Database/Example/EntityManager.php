<?php
namespace Jan\Component\Database\Example;


/**
 * Class EntityManager
 * @package Jan\Component\Database\Example
*/
class EntityManager
{

     /**
      * @var array
     */
     protected $updates = [];


     /**
      * @var array
     */
     protected $inserts = [];


     /**
      * @var array
     */
     protected $deletes = [];



     /**
      * @var array
     */
     protected $repositories = [];



     /**
      * @var bool
     */
     protected $flushed = false;



     /**
      * EntityManager constructor.
     */
     public function __construct()
     {
     }



    /**
     * @param $object
    */
    public function update($object)
    {
        $this->updates[] = $object;
    }



    /**
     * @param $object
    */
    public function persist($object)
    {
        $this->inserts[] = $object;
    }



     /**
      * @param $object
     */
     public function remove($object)
     {
          $this->deletes[] = $object;
     }



     /**
      * @param string $entityClass
      * @param ServiceRepository $repository
     */
     public function setRepository(string $entityClass, ServiceRepository $repository)
     {
          $this->repositories[$entityClass] = $repository;
     }


     /**
      * @param string $entityClass
      * @return mixed
     */
     public function getRepository(string $entityClass)
     {
           if(! \array_key_exists($entityClass, $this->repositories)) {
                dd($entityClass .' is not defined.');
           }

           return $this->repositories[$entityClass];
     }



     /**
      * @return void
     */
     public function flush()
     {
         if(! $this->flushed) {

             foreach ($this->updates as $object) {
                 dump($object);
                 echo "Updated object ( ". $object->getId() ." )";
             }

             foreach ($this->inserts as $object) {
                 echo "Inserted object ( ". $object->getId() ." )";
             }

             foreach ($this->deletes as $object) {
                 echo "Deleted object ( ". $object->getId() ." )";
             }

             $this->flushed = true;
         }
     }
}