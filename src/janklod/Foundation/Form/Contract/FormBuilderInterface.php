<?php
namespace Jan\Foundation\Form\Contract;


use Jan\Component\Http\Request;


/**
 * Interface FormBuilderInterface
 *
 * @package Jan\Foundation\Form\Contract
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
    public function handleRequest(Request $request);



    /**
     * create a html
     *
     * @param string|null $child
     * @param array $options
     * @return string|null
    */
    public function createView(string $child = null, array $options = []);




    /**
     * @return bool
    */
    public function isSubmit(): bool;


    /**
     * @return bool
     */
    public function isValid(): bool;
}