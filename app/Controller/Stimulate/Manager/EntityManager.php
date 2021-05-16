<?php
namespace App\Controller\Stimulate\Manager;


use Jan\Component\Database\ORM\Contract\EntityRepositoryInterface;

class EntityManager
{
    protected $persists = [];

    protected $removes = [];

    protected $updates = [];


    protected $entities = [];


    public function __construct()
    {

    }


    public function register($entityClass, $repositoryObject)
    {
         $this->entities[$entityClass] = $repositoryObject;
    }


    public function persist($entity)
    {
        $this->persists[] = $entity;
    }

    public function remove($entity)
    {
        $this->removes[] = $entity;
    }


    public function update($entity)
    {
        $this->updates[] = $entity;
    }


    public function flush()
    {
        foreach ($this->persists as $entity)
        {
             echo $entity .' persisted!';
        }
    }


    /**
     * @param string $entityClass
     * @return EntityRepositoryInterface|null
    */
    public function getRepository(string $entityClass): ?EntityRepositoryInterface
    {
        if(! \array_key_exists($entityClass, $this->entities)) {
            return null;
        }

        return $this->entities[$entityClass];
    }
}