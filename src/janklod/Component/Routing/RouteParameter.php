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

    const OPTION_PARAM_PATH_PREFIX      = 'prefix';
    const OPTION_PARAM_NAMESPACE        = 'namespace';
    const OPTION_PARAM_MIDDLEWARE       = 'middleware';
    const OPTION_PARAM_NAME_PREFIX      = 'name';


    /**
     * @var array
    */
    protected $options = [];


    /**
     * @param array $options
    */
    protected function addOptions(array $options)
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
            self::OPTION_PARAM_PATH_PREFIX,
            self::OPTION_PARAM_NAMESPACE,
            self::OPTION_PARAM_MIDDLEWARE,
            self::OPTION_PARAM_NAME_PREFIX
        ];
    }



    /**
     * @return string[]
    */
    protected function configureParameters(): array
    {
        return $this->resolvedRouteOptionParameters([
            self::PATH_PREFIX => $this->getOption(self::OPTION_PARAM_PATH_PREFIX),
            self::NAME_PREFIX => $this->getOption(self::OPTION_PARAM_NAME_PREFIX),
            self::NAMESPACE_PREFIX   => $this->getOption(self::OPTION_PARAM_NAMESPACE)
        ]);
    }



    /**
     * @param array $routeOptions
     * @return array
    */
    protected function resolvedRouteOptionParameters(array $routeOptions): array
    {
        $parameters = [];

        foreach ($routeOptions as $key => $value)
        {
            $parameters[$key] = (string) $value;
        }

        return $parameters;
    }
}