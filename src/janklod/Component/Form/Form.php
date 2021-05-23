<?php
namespace Jan\Component\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\Resolver\DataResolver;
use Jan\Component\Form\Type\InputType;
use Jan\Component\Form\Type\Support\AbstractType;


/**
 * Class Form
 * @package Jan\Component\Form
*/
class Form
{

     /**
      * @var mixed
     */
     protected $data;



     /**
      * @var array
     */
     protected $rows  = [];


     /**
      * @var array
     */
     protected $options = [

     ];



    /**
     * @var array
    */
    protected $html = [];



    /**
     * Form constructor.
     *
     * @param $data
     */
    public function __construct($data = null)
    {
        if($data) {
            $this->setData($data);
        }
    }


    /**
     * @param $data
     * @return Form
     */
    public function setData($data): Form
    {
        $this->data = $data;

        return $this;
    }



    /**
     * @param string $child
     * @param string|null $type
     * @param array $options
     * @return Form
    */
    public function add(string $child, string $type = null, array $options = []): Form
    {
        $resolver  = new OptionResolver($options);
        $inputType = new InputType($child, $resolver);

        if(! is_null($type)) {
            $inputType = new $type($child, $resolver);
        }

        if($inputType instanceof AbstractType) {
            $this->rows[$child] = $inputType;
            $this->html[] = $inputType->build();
        }

        return $this;
    }


    /**
     * @return array
    */
    public function getRows(): array
    {
        return $this->rows;
    }



    /**
     * @param string $child
     * @return mixed
     * @throws \Exception
    */
    public function getRow(string $child): mixed
    {
        if(\array_key_exists($child, $this->rows)) {
            throw new \Exception('child ('. $child . ') has not defined row.');
        }

        return $this->rows[$child];
    }



    /**
     * @param string|null $child
     * @return mixed
    */
    public function getData(string $child = null): mixed
    {
        if ($child) {

            $data = $this->data[$child];
            $resolver = new DataResolver($data);

            if(\is_object($data)) {
                //
            }
        }

        if(\is_object($this->data)) {
            return $this->data;
        }

        return null;
    }



    /**
     * @return string
    */
    public function createView(): string
    {
        return implode("\n", $this->html);
    }
}