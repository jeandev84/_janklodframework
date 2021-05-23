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
        $name = $this->getName();

        if($firstChild = $this->getOption('first_child')) {
            $name = $firstChild;
        }

        $html = parent::build();
        $html.= $this->make($name, $this->getOption('second_child'), $this->getOption('second_options'));

        return $html;
    }
}