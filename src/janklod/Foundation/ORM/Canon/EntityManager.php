<?php
namespace Jan\Foundation\ORM\Canon;


use Jan\Foundation\ORM\Canon\Contract\EntityManagerInterface;
use Jan\Foundation\ORM\Canon\Repository\EntityRepository;
use Jan\Foundation\ORM\Canon\Repository\Exception\EntityRepositoryException;


/**
 * Class EntityManager
 * @package Jan\Foundation\ORM\Canon
*/
class EntityManager implements EntityManagerInterface
{
      /**
       * @var array
      */
      protected $repositories = [];


      /**
       * @var array
      */
      protected $entityUpdates = [];


      /**
        * @var array
      */
      protected $entityInsertions = [];


      /**
        * @var array
      */
      protected $entityDeletions = [];



      /**
       * @param string $entityClass
       * @param EntityRepository $repository
      */
      public function setRepository(string $entityClass, EntityRepository $repository)
      {
            $this->repositories[$entityClass] = $repository;
      }


      /**
       * @param string $entityClass
       * @return EntityRepository
       * @throws EntityRepositoryException
      */
      public function getRepository(string $entityClass): EntityRepository
      {
          if(! \array_key_exists($entityClass, $this->repositories)) {
               throw new EntityRepositoryException(
                   sprintf('Entity (%s) is not available', $entityClass)
               );
          }

          return $this->repositories[$entityClass];
      }


      /**
       * @param $object
      */
      public function update($object)
      {
           $this->entityUpdates[] = $object;
      }


      /**
       * @param $object
      */
      public function persist($object)
      {
          $this->entityInsertions[] = $object;
      }



      /**
       * @param $object
      */
      public function remove($object)
      {
          $this->entityDeletions[] = $object;
      }


      public function flush()
      {

      }
}