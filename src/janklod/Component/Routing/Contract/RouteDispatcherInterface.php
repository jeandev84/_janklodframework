<?php
namespace Jan\Component\Routing\Contract;


/**
 * Class RouteDispatcherInterface
 * @package Jan\Component\Routing\Contract
*/
interface RouteDispatcherInterface
{
      /**
       * @param string $requestMethod
       * @param string $requestUri
       * @return mixed
      */
      public function dispatch(string $requestMethod, string $requestUri);
}