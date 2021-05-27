<?php
namespace Jan\Foundation\ORM\Canon\Repository;


use Jan\Foundation\ORM\Canon\Contract\EntityManagerInterface;
use Jan\Foundation\ORM\Canon\Contract\EntityRepositoryInterface;

/**
 * Class EntityRepository
 * @package Jan\Foundation\ORM\Canon\Repository
*/
class EntityRepository implements EntityRepositoryInterface
{

    /**
     * @var EntityManagerInterface
    */
    protected $em;


    /**
     * EntityRepository constructor.
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @param $id
     * @param null $lockMode
     * @param null $lockVersion
    */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        // TODO: Implement find() method.
    }


    /**
     * @param array $criteria
     * @param array|null $orderBy
    */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        // TODO: Implement findOneBy() method.
    }


    /**
     * @return mixed
    */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }


    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
    */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        // TODO: Implement findBy() method.
    }

}