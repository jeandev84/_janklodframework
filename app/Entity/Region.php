<?php
namespace App\Entity;


/**
 * Class Region
 * @package App\Entity
*/
class Region
{

      /**
       * @var int
      */
      protected $id;


      /**
       * @var string
      */
      protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return Region
    */
    public function setName(string $name): Region
    {
        $this->name = $name;

        return $this;
    }
}