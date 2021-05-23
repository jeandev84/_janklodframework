<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\DataResolver;
use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\Traits\FormTrait;
use Jan\Component\Form\Type\Support\Type;
use Jan\Component\Form\Type\TextType;
use Jan\Component\Http\Request;
use Jan\Contract\Form\FormBuilderInterface;



/**
 * Class Form
 * @package Jan\Foundation\Form
*/
class Form implements FormBuilderInterface
{

    use FormTrait;


    /**
     * @var array
     */
    protected $vars = [
        'parent' => null,
        'rows' => []
    ];



    /**
     * @var bool
     */
    protected $enabled = false;



    /**
     * @var bool
    */
    protected $started = false;



    /**
     * Form constructor.
     *
     * @param $data
    */
    public function __construct($data = null)
    {
        if($data) {
            $this->setVars(compact('data'));
            $this->setVar('data_class', \get_class($data));
        }
    }


    /**
     * @param Request $request
    */
    public function handle(Request $request)
    {
        // TODO: Implement handle() method.
    }


    /**
     * @param string $path
     * @param string $method
     * @param array $attrs
    */
    public function start(string $path = '/', string $method = "POST", array $attrs = [])
    {
        $str = $this->makeAttributes($attrs);
        /* ob_start(); */
        $this->vars['html'][] = '<form action="'. $path .'" method="'. $method .'" '. $attrs .'>';
        $this->started = true;
    }


    /**
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = array_merge($this->vars, $vars);
    }


    /**
     * @param $key
     * @param $value
     * @return Form
    */
    public function setVar($key, $value)
    {
        $this->vars[$key] = $value;

        return $this;
    }



    /**
     * @param $name
     * @param Type $type
     * @return $this
    */
    public function setRow($name, Type $type): Form
    {
        $this->vars['rows'][$name] = $type;

        return $this;
    }


    /**
     * @param string $formatHtml
     * @return $this
     */
    public function addFormat(string $formatHtml): Form
    {
        $this->vars['html'][] = $formatHtml;

        return $this;
    }


    /**
     * @param string $child
     * @param string|null $type
     * @param array $options
     * @return Form
     * @throws \Exception
    */
    public function add(string $child, ?string $type, array $options = []): Form
    {
        $options = array_merge($this->vars, $options);
        $resolver  = new OptionResolver($options);
        $row = new TextType($child, $resolver);

        if(! \is_null($type)) {
            $row = new $type($child, $resolver);
        }

        if($row instanceof Type) {
            $this->setRow($child, $row);
            $this->addFormat($row->build());
            /* $resolver->addOptions($options); */
        }

        return $this;
    }


    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->vars['rows'];
    }


    /**
     * @param string $child
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function getRow(string $child, array $options = [])
    {
        /* $this->createView(true); */
        if(! \array_key_exists($child, $this->vars['rows'])) {
            throw new \Exception('child ('. $child . ') has not defined row.');
        }

        /** @var Type $row */
        return $this->vars['rows'][$child];
    }


    /**
     * @param string $child
     * @param array $options
     * @return mixed
     * @throws \Exception
    */
    public function createRow(string $child, array $options = [])
    {
        $row = $this->getRow($child);
        $row->getOptionResolver()->addOptions($options);
        return $row->build();
    }



    /**
     * @param string|null $child
     * @return mixed
    */
    public function getData(string $child = null): mixed
    {
        if ($child) {

            $data = $this->vars[$child];
            $resolver = new DataResolver($data);

            if(\is_object($data)) {
                //
            }
        }

        if(\is_object($this->vars['data'])) {
            return $this->vars['data'];
        }

        return null;
    }


    /**
     * @return string
     */
    public function end()
    {
        $this->vars['html'][] = "</form>";

        if($this->started) {
            echo  $this->createView();
        }
    }



    /**
     * @param bool $disabled
     * @return string|null
    */
    public function createView(bool $disabled = false)
    {
        if($disabled === true) {
            return null;
        }

        return implode("\n", $this->vars['html']);
    }


    /**
     * @return bool
    */
    public function isSubmit(): bool
    {
         return $this->enabled;
    }


    /**
     * @return bool
    */
    public function isValid(): bool
    {
        return true;
    }
}