<?php
namespace App\Controller\Stimulate\Entity;


/**
 * Class User
 * @package App\Controller\Stimulate\Entity
*/
class User
{

    protected $id;

    protected $name;

    protected $surname;

    protected $address;

    protected $roles;

    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }


    public function isFederalOperator()
    {
         return in_array(Role::FEDERAL_OPERATOR, $this->roles);
    }


    public function isRegionalOperator()
    {
        return in_array(Role::REGIONAL_OPERATOR, $this->roles);
    }



    public function isExpert()
    {
        return in_array(Role::EXPERT, $this->roles);
    }

    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
}