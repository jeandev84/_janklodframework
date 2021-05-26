<?php
namespace Jan\Component\Form\Type\Support;



/**
 * Class InputType
 * @package Jan\Component\Form\Type\Support
*/
abstract class InputType extends BaseType
{
    public function buildLabel()
    {
        return '';
    }


    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        return $this->formatHtml($this->getTypeName(), $this->getChild(), $this->getOption('attr', []));
    }



    /**
     * make input field
     *
     * @param string $name
     * @param string $child
     * @param array $attrs
     * @return string
     * @throws \Exception
    */
    public function formatHtml(string $name, string $child, array $attrs = []): string
    {
        $attributes = $this->makeAttributes($attrs);
        return sprintf('<input type="%s" name="%s" %s>', $name, $child, $attributes);
    }



    /**
     * get name of form type
     *
     * @return string
    */
    abstract public function getTypeName(): string;
}