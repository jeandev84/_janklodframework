<?php
namespace Jan\Contract\Form;


use Jan\Component\Http\Request;

/**
 * Interface FormBuilderInterface
 *
 * @package Jan\Contract\Form
*/
interface FormBuilderInterface
{
    /**
     * @param string $child
     * @param string $type
     * @param array $options
     * @return FormInterface
    */
    public function add(string $child, string $type, array $options = []): FormInterface;
}