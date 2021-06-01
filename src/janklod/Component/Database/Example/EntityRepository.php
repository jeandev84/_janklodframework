<?php
namespace Jan\Component\Database\Example;


use App\Entity\User;

/**
 * Class EntityRepository
 * @package Jan\Component\Database\Example
*/
class EntityRepository
{

      protected $em;

      public function __construct(EntityManager $em)
      {
          $this->em = $em;
      }


      /**
       * @param $id
       * @return User
      */
      public function findOne($id)
      {
          $user = new User($id);
          $this->em->update($user);
          return $user;
      }
}