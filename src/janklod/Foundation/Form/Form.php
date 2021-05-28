<?php
namespace Jan\Foundation\Form;


use Jan\Component\Form\Resolver\OptionResolver;
use Jan\Component\Form\FormTrait;
use Jan\Component\Form\Type\Support\BaseType;
use Jan\Component\Form\Type\Support\FormEndType;
use Jan\Component\Form\Type\Support\FormStartType;
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

    const KEY_FORM_START     = 'form_start';
    const KEY_FORM_END       = 'form_end';
    const KEY_CHILDREN       = 'children';
    const KEY_HTML           = 'html';
    const KEY_DATA           = 'data';
    const KEY_DATA_CLASS     = 'data_class';
    const KEY_ERRORS         = 'errors';
    const KEY_METHOD         = 'method';
    const KEY_ACTION         = 'action';
    const KEY_NAME           = 'name';
    const KEY_SUBMIT_STATUS  = 'submitted';


    /**
     * @var array
    */
    protected $vars = [
        self::KEY_FORM_START    => null,
        self::KEY_FORM_END      => '</form>',
        self::KEY_CHILDREN      => [],
        self::KEY_DATA_CLASS    => null,
        self::KEY_DATA          => null,
        self::KEY_ERRORS        => [],
        self::KEY_HTML          => [],
        self::KEY_METHOD        => 'POST',
        self::KEY_ACTION        => '/',
        self::KEY_NAME          => 'form',
        self::KEY_SUBMIT_STATUS => false
    ];


    public function __construct($data = null)
    {
          if($data) {
              $this->setData($data);
          }
    }



    /**
     * @param $name
    */
    public function setName($name)
    {
        $this->setVars(compact('name'));
    }


    /**
     * @return array|null
    */
    public function getName()
    {
        return $this->getVar(static::KEY_NAME);
    }


    /**
     * @param string $method
     * @param string $action
     * @param array $attrs
     * @return FormBuilderInterface
    */
    public function start(string $method = 'POST', string $action = '/', array $attrs = [])
    {
         $defaults = compact('method', 'action');
         $this->setVars($defaults);

         $attributes = array_merge($defaults, $attrs);
         $child = $attributes[static::KEY_NAME] ?? $this->getName();
         $attributes['attr'] = $attributes;

         $resolver = new OptionResolver($attributes);
         $formView = new FormView($child, FormStartType::class, $resolver);

         $this->setVar(static::KEY_FORM_START, $formView);
         $this->addHtml($formView);
    }


    /**
     * @return string
    */
    public function end()
    {
        if(!\is_null($this->vars[static::KEY_FORM_START])) {
            return $this->buildHtml().$this->getVar(static::KEY_FORM_START);
        }
    }


    /**
     * add form child
     *
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

         $this->addChild($formView);
         $this->addHtml($formView);

         return $this;
    }


    /**
     * @param FormView $formView
     * @return Form
    */
    public function addChild(FormView $formView): Form
    {
        $this->vars[static::KEY_CHILDREN][$formView->getChild()] = $formView;

        return $this;
    }


    /**
     * @param FormView $formView
     * @return $this
    */
    public function addHtml(FormView $formView)
    {
        $this->vars[static::KEY_HTML][$formView->getChild()] = $formView->create();

        return $this;
    }


    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function setVar($key, $value): Form
    {
        $this->vars[$key] = $value;

        return $this;
    }



    /**
     * @param array $vars
    */
    public function setVars(array $vars)
    {
         $this->vars = array_merge($this->vars, $vars);
    }


    /**
     * @return array[]
    */
    public function getVars(): array
    {
        return $this->vars;
    }


    /**
     * @param string $key
     * @param null $default
     * @return mixed
    */
    public function getVar(string $key, $default = null)
    {
        return $this->vars[$key] ?? $default;
    }


    /**
     * @return array
    */
    public function getChildren(): array
    {
        return $this->vars[static::KEY_CHILDREN];
    }


    /**
     * @param string $child
     * @return mixed
     * @throws FormViewException
    */
    public function getChild(string $child)
    {
        if(! \array_key_exists($child, $this->getVar(static::KEY_CHILDREN))) {
            throw new FormViewException('child ('. $child . ') has not defined row.');
        }

        /** @var BaseType $row */
        return $this->vars[static::KEY_CHILDREN][$child];
    }



    /**
     * @param string|null $child
     * @return array|FomValue|null
    */
    public function getData(string $child = null)
    {
         $children = $this->getVar(static::KEY_CHILDREN);

         if(\array_key_exists($child, $children)) {
              return new FomValue($child, $this->vars[static::KEY_DATA]);
         }

         return $this->getVar(static::KEY_DATA);
    }



    /**
     * @param $data
    */
    public function setData($data)
    {
        $this->setVar(static::KEY_DATA, $data);
    }



    /**
     * @param Request $request
    */
    public function handleRequest(Request $request)
    {
        $data = null;

        if($request->getMethod() === 'POST') {
            /* $data = $request->getRequests(); */
            if($method = $request->request->get('_method')) {
                if(\in_array($method, ['PUT', 'DELETE', 'PATCH'])) {
                    $request->setMethod($method);
                    $request->request->remove('_method');
                }
            }

            $data = $request->getRequestData();
        }

         if ($request->getMethod() === 'GET') {
            $data = $request->queryParams->all();
         }

         if($request->isPut()) { /* dd('YES IS PUT'); */ }

         if($data) {

             if(! $dataClass = $this->getVar(static::KEY_DATA_CLASS)) {
                  $this->setData($data);
             }

             // TODO via DI container make object
             if(! $objMapped = $this->getVar(self::KEY_DATA)) {
                 $objMapped = $this->getVar(self::KEY_DATA);
             }

             if($objMapped) {
                 try {
                     $reflectedObject = new \ReflectionObject($objMapped);
                     foreach ($reflectedObject->getProperties() as $property) {
                         $property->setAccessible(true);
                         if(\array_key_exists($field = $property->getName(), $data)) {
                             $property->setValue($objMapped, trim($data[$field]));
                         }
                     }
                 } catch (\ReflectionException $e) {
                     throw $e;
                 }

                 $this->setData($objMapped);
             }

             $this->setVar(static::KEY_SUBMIT_STATUS, true);
         }
    }


    /**
     * @param string|null $child
     * @param array $options
     * @return string
     * @throws FormViewException
    */
    public function createView(string $child = null, array $options = [])
    {
        /** @var FormView $formView */
        if($child) {

             /** @var OptionResolver $resolver */
             $resolver = $this->getChild($child)->getOptionResolver();
             if($options) {
                 $resolver->setOptions($options);
             }

             return $this->getChild($child)->create();
        }

        if(\is_null($this->vars[static::KEY_FORM_START])) {
            return $this->buildHtml();
        }

        return null;
    }


    /**
     * @return string
    */
    public function buildHtml(): string
    {
        return implode("\n", $this->getVar(static::KEY_HTML));
    }


    /**
     * @return bool
    */
    public function isSubmit(): bool
    {
        return $this->getVar(static::KEY_SUBMIT_STATUS);
    }


    /**
     * @return bool
    */
    public function isValid(): bool
    {
        return true;
    }
}