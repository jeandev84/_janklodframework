<?php
namespace Jan\Foundation\ORM\Canon;


use Jan\Component\Database\Contract\ConnectionInterface;
use Jan\Foundation\ORM\Canon\Contract\EntityManagerInterface;
use Jan\Foundation\ORM\Canon\Repository\EntityRepository;
use Jan\Foundation\ORM\Canon\Repository\Exception\EntityRepositoryException;
use Jan\Foundation\ORM\Canon\Repository\ServiceRepository;


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
        * @var ConnectionInterface
      */
      protected $connection;


      /**
       * EntityManager constructor.
       * @param ConnectionInterface|null $connection
      */
      public function __construct(ConnectionInterface $connection = null)
      {
            if($connection) {
                $this->setConnection($connection);
            }
      }


      /**
        * @param ConnectionInterface $connection
      */
      public function setConnection(ConnectionInterface $connection)
      {
          $this->connection = $connection;
      }


      /**
       * @return ConnectionInterface
      */
      public function getConnection()
      {
           return $this->connection;
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
       * @return ServiceRepository
       * @throws EntityRepositoryException
      */
      public function getRepository(string $entityClass): ServiceRepository
      {
          if(! \array_key_exists($entityClass, $this->repositories)) {
               throw new EntityRepositoryException(
                   sprintf('Entity (%s) is not available', $entityClass)
               );
          }

          return $this->repositories[$entityClass];
      }


      /**
       * @return array
      */
      public function getRepositories(): array
      {
          return $this->repositories;
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