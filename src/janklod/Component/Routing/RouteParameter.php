<?php
namespace Jan\Component\Routing;


/**
 * Class RouteParameter
 * @package Jan\Component\Routing
*/
class RouteParameter
{

    const KEY_OPTION_PARAM_PATH_PREFIX  = 'path.prefix';
    const KEY_OPTION_PARAM_NAMESPACE    = 'namespace';
    const KEY_OPTION_PARAM_NAME_PREFIX  = 'name.prefix';

    const OPTION_PARAM_PATH_PREFIX      = 'prefix';
    const OPTION_PARAM_NAMESPACE        = 'namespace';
    const OPTION_PARAM_MIDDLEWARE       = 'middleware';
    const OPTION_PARAM_NAME_PREFIX      = 'name';


    protected $router;


    public function __construct(Router $router)
    {
         $this->router = $router;
    }



    /**
     * @param $index
     * @return bool
    */
    protected static function isOptionValid($index): bool
    {
        return \in_array($index, static::getAvailable());
    }



    /**
     * @return string[]
     */
    protected static function getAvailable(): array
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
            self::KEY_OPTION_PARAM_PATH_PREFIX => $this->router->getOption(self::OPTION_PARAM_PATH_PREFIX),
            self::KEY_OPTION_PARAM_NAME_PREFIX => $this->router->getOption(self::OPTION_PARAM_NAME_PREFIX),
            self::KEY_OPTION_PARAM_NAMESPACE   => $this->router->getOption(self::OPTION_PARAM_NAMESPACE)
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