<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\FormTrait;
use Jan\Component\Form\Type\Support\BaseType;
use Jan\Component\Form\Type\TextType;
use Jan\Component\Http\Request;
use Jan\Foundation\Form\Contract\FormBuilderInterface;
use Jan\Foundation\Form\Exception\FormViewException;


/**
 * Class Form
 * @package Jan\Foundation\Form
*/
class Form implements FormBuilderInterface
{

    use FormTrait;


    const KEY_CHILDREN     = 'children';
    const KEY_HTML         = 'html';
    const KEY_DATA         = 'data';
    const KEY_DATA_CLASS   = 'data_class';
    const KEY_ERRORS       = 'errors';
    const KEY_VALUES       = 'values';


    /**
     * @var array[]
    */
    protected $vars = [
        self::KEY_CHILDREN    => [],
        self::KEY_DATA_CLASS  => null,
        self::KEY_DATA        => null,
        self::KEY_ERRORS      => [],
        self::KEY_VALUES      => [],
        self::KEY_HTML        => [],
    ];



    /**
      * @var bool
    */
    protected $submitted = false;


    /**
     * @param string $child
     * @param string $type
     * @param array $options
     * @return FormBuilderInterface
    */
    public function add(string $child, string $type, array $options = []): FormBuilderInterface
    {
         $resolver = new OptionResolver($options);
         $formView = new FormView($child, TextType::class, $resolver);

         if(! \is_null($type)) {
             $formView = new FormView($child, $type, $resolver);
         }

         $this->vars[static::KEY_CHILDREN][$child] = $formView;
         $this->vars[static::KEY_HTML][] = $formView->create();

         return $this;
    }




    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function setVar($key, $value)
    {
        $this->vars[$key] = $value;

        return $this;
    }


    /**
     * @return array[]
    */
    public function getVars()
    {
        return $this->vars;
    }


    /**
     * @param string $key
     * @param null $default
     * @return array|null
    */
    public function getVar(string $key, $default = null): ?array
    {
        return $this->vars[$key] ?? $default;
    }

    public function getRows()
    {
        return '';
    }


    public function getRow()
    {

    }


    /**
     * @param string|null $child
     * @return array|FomValue|null
    */
    public function getData(string $child = null)
    {
         $children = $this->getVar(static::KEY_CHILDREN);

         if(\array_key_exists($child, $children)) {
              $formView = $children[$child];
              return new FomValue($formView);
         }

         return $this->getVar(static::KEY_DATA);
    }


    /**
     * @param Request $request
    */
    public function handleRequest(Request $request)
    {
        // TODO: Implement handleRequest() method.
    }



    /**
     * @param bool $disabled
     * @return string
    */
    public function createView(bool $disabled = false): string
    {
        return implode("\n", $this->vars[static::KEY_HTML]);
    }


    /**
     * @return bool
    */
    public function isSubmit(): bool
    {
        // TODO: Implement isSubmit() method.
    }


    /**
     * @return bool
    */
    public function isValid(): bool
    {
        // TODO: Implement isValid() method.
    }
}