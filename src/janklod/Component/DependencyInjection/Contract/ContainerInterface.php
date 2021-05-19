<?php
namespace Jan\Component\DependencyInjection\Contract;

/**
 * Interface ContainerInterface
 * @package Jan\Component\DependencyInjection\Contract
*/
interface ContainerInterface
{

      /**
       * @param $id
       * @return bool
      */
      public function has($id);


      /**
       * @param $id
       * @return mixed
      */
      public function get($id);
}