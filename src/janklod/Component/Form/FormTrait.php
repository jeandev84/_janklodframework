<?php
namespace Jan\Component\Form;


/**
 * Trait FormTrait
 *
 * @package Jan\Component\Form
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