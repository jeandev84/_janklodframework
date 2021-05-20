<?php
namespace Jan\Foundation\Routing\Contract;


/**
 * Class RouteDispatcherInterface
 * @package Jan\Foundation\Routing\Contract
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