<?php
namespace Jan\Foundation\Form;


use Exception;
use ReflectionObject;


/**
 * Class FomValue
 * @package Jan\Foundation\Form
*/
class FomValue
{

     /**
      * @var string
     */
     protected $child;


     /**
      * @var array|object
     */
     protected $data;



     /**
      * FomValue constructor.
      * @param $child
      * @param $data
     */
     public function __construct($child, $data)
     {
         $this->child = $child;
         $this->data  = $data;
     }


     /**
      * @throws \Exception
     */
     public function getValues()
     {
         if(\is_array($this->data) && \array_key_exists($this->child, $this->data)) {
             return $this->data[$this->child];
         }

         if(is_object($this->data)) {
             if(\array_key_exists($this->child, $properties = $this->getProperties($this->data))) {
                 return $properties[$this->child];
             }
         }

         return null;
     }


    /**
     * @param object $object
     * @return array
     * @throws Exception
    */
    protected function getProperties($object): array
    {
        $mappedProperties = [];

        if(\is_object($object)) {

            $reflectedObject = new ReflectionObject($object);

            foreach($reflectedObject->getProperties() as $property) {
                $property->setAccessible(true);
                $mappedProperties[$property->getName()] = $property->getValue($object);
            }
        }

        return $mappedProperties;
    }
}