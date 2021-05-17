<?php
namespace Jan\Component\Routing;


/**
 * Class RouteParameter
 * @package Jan\Component\Routing
*/
class RouteParameter
{

    const PATH_PREFIX                   = 'path.prefix';
    const NAMESPACE_PREFIX              = 'namespace';
    const NAME_PREFIX                   = 'name.prefix';

    const PARAM_PATH_PREFIX      = 'prefix';
    const PARAM_NAMESPACE        = 'namespace';
    const PARAM_MIDDLEWARE       = 'middleware';
    const PARAM_NAME_PREFIX      = 'name';


    /**
     * @var array
    */
    protected $options = [];


    /**
     * @param array $options
    */
    public function addOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }


    /**
     * @param $key
     * @param $value
    */
    public function addOption($key, $value)
    {
        $this->options[$key] = $value;
    }



    /**
     * remove all options options
     *
     * @return void
    */
    public function flushOptions()
    {
        $this->options = [];
    }


    /**
     * flush parameters and options
    */
    public function flush()
    {
        $this->options = [];
    }


    /**
     * @param $key
    */
    protected function removeOption($key)
    {
        unset($this->options[$key]);
    }



    /**
     * Get option by given param
     *
     * @param $key
     * @param null $default
     * @return mixed|void|null
    */
    public function getOption($key, $default = null)
    {
        foreach (array_keys($this->options) as $index) {
            if(! $this->isValidOption($index)) {
                return new \Exception(sprintf('%s is not available this param', $index));
            }
        }

        return $this->options[$key] ?? $default;
    }


    /**
     * @param $methods
     * @return array
    */
    public function resolvedMethods($methods)
    {
        if(is_string($methods)) {
            $methods = explode('|', $methods);
        }
        return (array) $methods;
    }


    /**
     * @param $path
     * @return mixed|string
    */
    public function resolvedPath($path)
    {
        if($prefix = $this->getOption(static::PARAM_PATH_PREFIX)) {
            $path = rtrim($prefix, '/') . '/'. ltrim($path, '/');
        }
        return $path;
    }



    /**
     * Resolve handle
     *
     * @param $target
     * @return mixed
    */
    public function resolvedTarget($target)
    {
        if(\is_string($target) && $namespace = $this->getOption(static::PARAM_NAMESPACE)) {
            $target = rtrim(ucfirst($namespace), '\\') .'\\' . $target;
        }
        return $target;
    }



    /**
     * @param $name
     * @return string
    */
    public function resolvedName($name): string
    {
        if($prefixed = $this->getOption(static::PARAM_NAME_PREFIX)) {
            return $prefixed . $name;
        }
        return $name;
    }


    /**
     * @return \Exception|mixed|void|null
    */
    public function getMiddlewares()
    {
        return $this->getOption(self::PARAM_MIDDLEWARE, []);
    }


    /**
     * @return \Exception|mixed|void|null
    */
    public function getPrefixName()
    {
        return $this->getOption(static::PARAM_NAME_PREFIX, '');
    }



    /**
     * @param $key
     * @return bool
    */
    protected function isValidOption($key): bool
    {
        return \in_array($key, $this->getOptionParams());
    }



    /**
     * @return string[]
    */
    protected function getOptionParams(): array
    {
        return [
            self::PARAM_PATH_PREFIX,
            self::PARAM_NAMESPACE,
            self::PARAM_MIDDLEWARE,
            self::PARAM_NAME_PREFIX
        ];
    }



    /**
     * @return string[]
    */
    public function configureParameters(): array
    {
        return [
            self::PATH_PREFIX      => (string) $this->getOption(self::PARAM_PATH_PREFIX),
            self::NAME_PREFIX      => (string) $this->getOption(self::PARAM_NAME_PREFIX),
            self::NAMESPACE_PREFIX => (string) $this->getOption(self::PARAM_NAMESPACE)
        ];
    }
}