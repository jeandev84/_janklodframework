<?php
namespace Jan\Component\Form\Type;


/**
 * Class PasswordType
 * @package Jan\Component\Form\Type
*/
class PasswordType extends InputType
{
    /**
     * @return string
    */
    public function getName(): string
    {
        return 'password';
    }
}