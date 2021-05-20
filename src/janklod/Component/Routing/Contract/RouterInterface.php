<?php
namespace Jan\Component\Routing\Contract;


/**
 * Interface RouterInterface
 * @package Jan\Component\Routing\Contract
*/
interface RouterInterface
{

      /**
       * @return array
      */
      public function getRoutes();



      /**
       * @param string $requestMethod
       * @param string $requestUri
       * @return mixed
      */
      public function match(string $requestMethod, string $requestUri);
}