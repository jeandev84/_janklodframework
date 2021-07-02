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

    const KEY_FORM_BEGIN     = 'started';
    const KEY_FORM_VALID     = 'valid';
    const KEY_CHILDREN       = 'children';
    const KEY_HTML           = 'html';
    const KEY_DATA           = 'data';
    const KEY_DATA_CLASS     = 'data_class';
    const KEY_VALUES         = 'values';
    const KEY_ERRORS         = 'errors';
    const KEY_METHOD         = 'method';
    const KEY_ACTION         = 'action';
    const KEY_NAME           = 'name';
    const KEY_SUBMIT_STATUS  = 'submitted';


    /**
     * @var array
    */
    protected $config = [
        self::KEY_CHILDREN      => [],
        self::KEY_DATA_CLASS    => null,
        self::KEY_DATA          => null,
        self::KEY_VALUES        => [],
        self::KEY_ERRORS        => [],
        self::KEY_HTML          => [],
        self::KEY_METHOD        => 'POST',
        self::KEY_ACTION        => '/',
        self::KEY_NAME          => 'form',
        self::KEY_FORM_BEGIN    => false,
        self::KEY_SUBMIT_STATUS => false,
        self::KEY_FORM_VALID    => false
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
        $this->configs(compact('name'));
    }


    /**
     * @return array|null
    */
    public function getName()
    {
        return $this->getConfig(static::KEY_NAME);
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
         $this->configs($defaults);

         $attributes = array_merge($defaults, $attrs);
         $child = $attributes[static::KEY_NAME] ?? $this->getName();
         $attributes['attr'] = $attributes;

         $resolver = new OptionResolver($attributes);
         $formView = new FormView($child, FormStartType::class, $resolver);

         $this->config(static::KEY_FORM_BEGIN, true);
         $this->addHtml($formView);

         return $this;
    }


    /**
     * @return string
    */
    public function end()
    {
        if($this->getConfig(static::KEY_FORM_BEGIN)) {
            return $this->buildHtml(['</form>']);
        }
    }


    /**
     * @param $child
     * @return mixed|null
    */
    public function getValues($child)
    {
        $values = $this->getConfig(static::KEY_VALUES);

        return $values[$child] ?? null;
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

         /*
         $value = $this->getValues($child);
         $resolver->setValue($value);
         */

         if(\is_null($type)) {
              $type = TextType::class;
         }

         $formView = new FormView($child, $type, $resolver);
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
        $this->config[static::KEY_CHILDREN][$formView->getChild()] = $formView;

        return $this;
    }



    /**
     * @param FormView $formView
     * @return $this
    */
    public function addHtml(FormView $formView)
    {
        $this->config[static::KEY_HTML][$formView->getChild()] = $formView->create();

        return $this;
    }


    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function config($key, $value): Form
    {
        $this->config[$key] = $value;

        return $this;
    }



    /**
     * @param array $config
    */
    public function configs(array $config)
    {
         $this->config = array_merge($this->config, $config);
    }


    /**
     * @return array[]
    */
    public function getConfigs(): array
    {
        return $this->config;
    }


    /**
     * @param string $key
     * @param null $default
     * @return mixed
    */
    public function getConfig(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }


    /**
     * @return array
    */
    public function getChildren(): array
    {
        return $this->config[static::KEY_CHILDREN];
    }


    /**
     * @param string $child
     * @return mixed
     * @throws FormViewException
    */
    public function getChild(string $child)
    {
        if(! \array_key_exists($child, $this->getConfig(static::KEY_CHILDREN))) {
            throw new FormViewException('child ('. $child . ') has not defined row.');
        }

        /** @var BaseType $row */
        return $this->config[static::KEY_CHILDREN][$child];
    }



    /**
     * @param string|null $child
     * @return array|FormValue|null
    */
    public function getData(string $child = null)
    {
         $children = $this->getConfig(static::KEY_CHILDREN);

         if(\array_key_exists($child, $children)) {
              // TODO refactoring
              return new FormValue($child, $this->config[static::KEY_DATA]);
         }

         return $this->getConfig(static::KEY_DATA);
    }



    /**
     * @param $data
    */
    public function setData($data)
    {
        $this->config(static::KEY_DATA, $data);
    }



    /**
     * @param Request $request
    */
    public function handleRequest(Request $request)
    {
        $data = null;
        $requestMethod = $request->getMethod();

        switch ($requestMethod) {
            case 'POST':
                /* $data = $request->getRequests(); */
                if($method = $request->request->get('_method')) {
                    if(\in_array($method, ['PUT', 'DELETE', 'PATCH'])) {
                        $request->setMethod($method);
                        $request->request->remove('_method');
                    }
                }

                $data = $request->getRequestData();
                break;
            case 'GET':
                $data = $request->queryParams->all();
                break;
            default:
                break;
        }

        /*
        if($request->getMethod() === 'POST') {
            // $data = $request->getRequests();
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
        */

        if($request->isPut()) { /* dd('YES IS PUT'); */ }

        if($data) {

             if(! $dataClass = $this->getConfig(static::KEY_DATA_CLASS)) {
                  $this->setData($data);
             }

             // TODO via DI container make object
             if(! $objMapped = $this->getConfig(self::KEY_DATA)) {
                 $objMapped = $this->getConfig(self::KEY_DATA);
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

             $items = [
                 static::KEY_VALUES => $data,
                 static::KEY_SUBMIT_STATUS => true
             ];

             $this->configs($items);
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
        if($child) {

             $formView = $this->getChild($child);
             $resolver = $formView->getOptionResolver();

             if($options) {
                 $resolver->setOptions($options);
             }

             return $formView->create();
        }

        if(! $this->getConfig(static::KEY_FORM_BEGIN)) {
            return $this->buildHtml();
        }

        return null;
    }


    /**
     * @param array $appends
     * @return string
    */
    public function buildHtml(array $appends = []): string
    {
        $htmlParts = array_merge($this->getConfig(static::KEY_HTML), $appends);
        return implode("\n", $htmlParts);
    }


    /**
     * @return bool
    */
    public function isSubmit(): bool
    {
        return $this->getConfig(static::KEY_SUBMIT_STATUS);
    }


    /**
     * @return bool
    */
    public function isValid(): bool
    {
        return $this->isSubmit() && true;
    }


    /**
     * @param Request $request
     * @return bool
     * @throws \ReflectionException
    */
    public function parse(Request $request)
    {
        $this->handleRequest($request);

        return $this->isValid();
    }
}