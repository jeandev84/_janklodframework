<?php
namespace Jan\Component\Container\Contract;



/**
 * Interface ContainerAwareInterface
 * @package Jan\Component\DependencyInjection\Contract
*/
interface ContainerAwareInterface
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