<?php
namespace Jan\Foundation\Routing\Contract;


use Jan\Component\Http\Request;

/**
 * Class RouteDispatcherInterface
 * @package Jan\Foundation\Routing\Contract
 */
interface RouteDispatcherInterface
{
     /**
      * @param Request $request
      * @return mixed
     */
     public function dispatch(Request $request);
}