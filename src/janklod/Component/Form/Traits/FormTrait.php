<?php
namespace Jan\Component\Form\Traits;


/**
 * Trait FormTrait
 *
 * @package Jan\Component\Form\Traits
*/
trait FormTrait
{

    /**
     * @param array $attrs
     * @return string
    */
    public function makeAttributes(array $attrs): string
    {
        $str = '';
        foreach ($attrs as $key => $value) {
            if(\is_string($value)) {
                $str .= sprintf(' %s="%s"', $key, $value);
            }
        }
        return $str;
    }
}