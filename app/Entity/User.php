<?php
namespace App\Entity;


/**
 * Class User
 * @package App\Entity
*/
class User
{

     /**
      * @var int
     */
     protected $id;


     /**
      * @var string
     */
     protected $email;


     /**
      * @var string
     */
     protected $password;


     /**
      * @var string
     */
     protected $address;


     protected $roles = [];


     /**
      * User constructor.
     */
     public function __construct()
     {
     }

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
    */
    public function getPassword(): string
    {
        return $this->password;
    }



    /**
     * @param string $password
     * @return User
    */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }



    /**
     * @param string $address
     * @return User
    */
    public function setAddress(string $address): User
    {
        $this->address = $address;

        return $this;
    }


    /**
     * @return array
    */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
    */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

}