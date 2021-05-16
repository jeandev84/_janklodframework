<?php
namespace Jan\Component\Database\ORM\Contract;


/**
 * Interface EntityRepositoryInterface
 * @package Jan\Component\Database\ORM\Contract
*/
interface EntityRepositoryInterface
{
     public function find($id, $lockMode = null, $lockVersion = null);
     public function findOneBy(array $criteria, array $orderBy = null);
     public function findAll();
     public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}