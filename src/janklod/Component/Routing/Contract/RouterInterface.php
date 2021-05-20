<?php
namespace Jan\Component\Routing\Contract;


/**
 * Interface RouterInterface
 * @package Jan\Component\Routing\Contract
*/
interface RouterInterface extends UrlMatcherInterface, MethodMatcherInterface, UrlGeneratorInterface
{
      /**
       * get routes collection
       *
       * @return array
      */
      public function getRoutes();
}