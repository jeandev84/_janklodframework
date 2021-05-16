<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\ORM\Contract\EntityRepositoryInterface;

/**
 * Class EntityRepository
 * @package Jan\Component\Database\ORM
*/
class EntityRepository implements EntityRepositoryInterface
{

    public function find($id, $lockMode = null, $lockVersion = null)
    {
        // TODO: Implement find() method.
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        // TODO: Implement findOneBy() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        // TODO: Implement findBy() method.
    }
}