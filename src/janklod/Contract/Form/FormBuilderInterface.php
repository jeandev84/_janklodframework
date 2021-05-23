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
     * @return FormBuilderInterface
    */
    public function add(string $child, string $type, array $options = []): FormBuilderInterface;



    /**
     * @param Request $request
     * @return void
    */
    public function handle(Request $request);



    /**
     * create a html
     *
     * @param bool $disabled
     * @return string|null
    */
    public function createView(bool $disabled = false);




    /**
     * @return bool
    */
    public function isSubmit(): bool;


    /**
     * @return bool
     */
    public function isValid(): bool;
}