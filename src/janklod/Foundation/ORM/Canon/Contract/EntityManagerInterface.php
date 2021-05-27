<?php
namespace Jan\Foundation\ORM\Canon\Contract;


/**
 * Interface EntityManagerInterface
 * @package Jan\Foundation\ORM\ORM\Canon\Contract
*/
interface EntityManagerInterface
{
      /**
       * @param string $entityClass
       * @return EntityRepositoryInterface
      */
      public function getRepository(string $entityClass): EntityRepositoryInterface;
}