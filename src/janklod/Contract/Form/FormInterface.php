<?php
namespace Jan\Contract\Form;


use Jan\Component\Http\Request;


/**
 * Interface FormInterface
 *
 * @package Jan\Contract\Form
*/
interface FormInterface extends FormBuilderInterface
{

      /**
       * @param Request $request
       * @return void
      */
      public function handle(Request $request);



     /**
      * create a html
      *
      * @return string
     */
     public function createView(): string;

}