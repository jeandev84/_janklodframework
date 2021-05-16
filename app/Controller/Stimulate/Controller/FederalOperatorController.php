<?php
namespace App\Controller\Stimulate\Controller;


use App\Controller\Stimulate\Entity\Applicant\Applicant;
use App\Controller\Stimulate\Entity\FederalOperator;
use App\Controller\Stimulate\Entity\RegionalOperator;
use App\Controller\Stimulate\Entity\Role;
use App\Controller\Stimulate\Entity\User;
use App\Controller\Stimulate\Manager\EntityManager;

/**
 * Class FederalOperatorController
 * @package App\Controller\Stimulate\Controller
*/
class FederalOperatorController
{

       protected $em;

      public function __construct()
      {
          $this->em = new EntityManager();
      }

      public function create()
      {
           $currentUser = $this->getUser();

           if(! $currentUser->isFederalOperator() || ! $currentUser->isRegionalOperator())
           {
                dd('Access denined');
           }

           /** @var User $user */
           $user = new User([Role::EXPERT]);
           $user->setName('Kouassi Jean-Claude')
                ->setSurname('Yao')
                ->setAddress('rue Montpelier dom 8')
           ;

           /** @var Applicant $currentUser */
           $currentUser->addUser($user);
           $this->em->persist($currentUser);
           $this->em->persist($user);
           $this->em->flush();
      }


      public function getUser()
      {
           return new User([]);
      }



      public function getUsers()
      {
          $currentUser = $this->getUser();
          $ids = $currentUser->getId();

          /** @var Applicant $applicant */
          $applicant = $this->em->getRepository(Applicant::class)->findOneBy(['id' => $ids]);

          return $applicant->getUsers();
      }
}