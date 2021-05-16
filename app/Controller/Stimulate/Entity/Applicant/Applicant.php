<?php
namespace App\Controller\Stimulate\Entity\Applicant;


use App\Controller\Stimulate\Entity\User;

/**
 * Class Applicant
 * @package App\Controller\Stimulate\Entity\Applicant
*/
class Applicant
{
//    const FEDERAL_OPERATOR = 'fed_op';
//    const REGIONAL_OPERATOR = 'reg_op';
//    const EXPERT = 'expert';


    protected $id;


    /**
     * ManyToMany
     * @var User[]
    */
    protected $users;



    protected $genres = [];


    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
         $this->users[] = $user;
    }


    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }


    public function isFederalOperator(User $user)
    {
         return $user->isFederalOperator();
    }


    public function isRegionalOperator(User $user)
    {
        return $user->isRegionalOperator();
    }


    public function canCreate(User $user)
    {
        return $user->isFederalOperator() || $user->isRegionalOperator();
    }

}