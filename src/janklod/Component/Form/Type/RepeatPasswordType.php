<?php
namespace Jan\Component\Form\Type;


/**
 * Class RepeatPasswordType
 *
 * @package Jan\Component\Form\Type
*/
class RepeatPasswordType extends PasswordType
{
    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        // TODO Refactoring
        // name of input type (password)
        $name = $this->getTypeName();

        //
        if($firstChild = $this->getVar('first_child')) {
            $name = $firstChild;
        }

        $html = parent::build();
        $html.= $this->formatHtml($name, $this->getVar('second_child'), $this->getVar('second_options'));
        return $html;
    }
}