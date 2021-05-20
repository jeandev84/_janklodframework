<?php
namespace Jan\Component\Routing\Contract;


/**
 * Interface MethodMatcherInterface
 * @package Jan\Component\Routing\Contract
*/
interface MethodMatcherInterface
{
    /**
     * @param string $method
     * @return mixed
    */
    public function matchMethod(string $method);
}