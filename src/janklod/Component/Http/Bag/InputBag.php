<?php
namespace Jan\Component\Http\Bag;


/**
 * Class InputBag
 * @package Jan\Component\Http\Bag
*/
class InputBag extends ParameterBag
{
    /**
     * @param $key
     * @param int $default
     * @return int
    */
    public function getInt($key, int $default = 0): int
    {
        return (int) $this->get($key, $default);
    }
}