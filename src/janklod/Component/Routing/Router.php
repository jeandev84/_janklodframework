<?php
namespace Jan\Component\Routing;


use Closure;

/**
 * Class Router
 * @package Jan\Component\Routing
*/
class Router extends RouteCollection
{

    const KEY_OPTION_PARAM_PATH_PREFIX  = 'path.prefix';
    const KEY_OPTION_PARAM_NAMESPACE    = 'namespace';
    const KEY_OPTION_PARAM_NAME_PREFIX  = 'name.prefix';

    const OPTION_PARAM_PATH_PREFIX      = 'prefix';
    const OPTION_PARAM_NAMESPACE        = 'namespace';
    const OPTION_PARAM_MIDDLEWARE       = 'middleware';
    const OPTION_PARAM_NAME_PREFIX      = 'name';



    /**
     * route patterns
     *
     * @var array
    */
    protected $patterns = [];




    /**
     * @var array
    */
    protected $options = [];




    /**
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function get(string $path, $target, string $name = null): Route
    {
        return $this->map(['GET'], $path, $target, $name);
    }


    /**
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function post(string $path, $target, string $name = null): Route
    {
        return $this->map(['POST'], $path, $target, $name);
    }



    /**
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function put(string $path, $target, string $name = null): Route
    {
        return $this->map(['PUT'], $path, $target, $name);
    }




    /**
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function delete(string $path, $target, string $name = null): Route
    {
        return $this->map(['DELETE'], $path, $target, $name);
    }




    /**
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function any(string $path, $target, string $name = null): Route
    {
        return $this->map('GET|POST|PUT|DELETE', $path, $target, $name);
    }



    /**
     * @param Closure $routeCallback
     * @param array $options
     */
    public function group(Closure $routeCallback, array $options = [])
    {
        /*
        if(! isset($options[self::OPTION_PARAM_PATH_PREFIX])) {
            $options[self::OPTION_PARAM_PATH_PREFIX] = '/';
        }
        */

        if($options) {
            $this->addOptions($options);
        }

        /* $this->isRouteGroup = true; */
        $routeCallback($this);
        $this->flushOptions();
    }


    /**
     * @param array|string $methods
     * @param string $path
     * @param $target
     * @param string|null $name
     * @return Route
    */
    public function map($methods, string $path, $target, string $name = null): Route
    {
        /* resolve given params */
        // resolve given params
        $methods    = $this->resolveMethods($methods);
        $path       = $this->resolvePath($path);
        $target     = $this->resolveTarget($target);
        $middleware = $this->getOption(static::OPTION_PARAM_MIDDLEWARE, []);
        $prefixName = $this->getOption(static::OPTION_PARAM_NAME_PREFIX, '');


        $route = new Route($methods, $path, $target);
        $route->where($this->patterns);
        $route->setPrefixName($prefixName);
        $route->middleware($middleware);
        $route->addOptions($this->routeParameters());

        if($name) {
            $route->name($name);
        }

        return $this->add($route);
    }



    /**
     * @param $name
     * @param $regex
     * @return Router
     *
     * Example:
     * $router = new Router();
     * $router->pattern('id', '[0-9]+');
     * $router->pattern(['id' => '[0-9]+']);
     */
    public function pattern($name, $regex = null): Router
    {
        $patterns = is_array($name) ? $name : [$name => $regex];

        $this->patterns = array_merge($this->patterns, $patterns);

        return $this;
    }


    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): Router
    {
        $this->addOptions(compact('name'));

        return $this;
    }


    /**
     * @param array $middleware
     * @return $this
    */
    public function middleware(array $middleware): Router
    {
        $this->addOptions(compact('middleware'));

        return $this;
    }


    /**
     * @param $prefix
     * @return Router
     */
    public function prefix($prefix): Router
    {
        $this->addOptions(compact('prefix'));

        return $this;
    }


    /**
     * @param $namespace
     * @return Router
     */
    public function namespace($namespace): Router
    {
        $this->addOptions(compact('namespace'));

        return $this;
    }


    /**
     * @param Closure|null $closure
     * @param array $options
     * @return Router
     */
    public function api(Closure $closure = null, array $options = []): Router
    {
        if(! isset($options[self::OPTION_PARAM_PATH_PREFIX])) {
            $options[self::OPTION_PARAM_PATH_PREFIX] = 'api';
        }

        /*
        $options = [
            self::OPTION_PARAM_PATH_PREFIX => $options[self::OPTION_PARAM_PATH_PREFIX] ?? 'api'
        ];
        */

        if(! $closure) {
            $this->addOptions($options);
            return $this;
        }

        $this->group($closure, $options);
    }


    /**
     * @param string $requestMethod
     * @param string $requestUri
     * @return Route|bool
    */
    public function match(string $requestMethod, string $requestUri)
    {
        foreach ($this->getRoutes() as $route) {

            /** @var Route $route */
            if($route instanceof Route) {
                if($route->match($requestMethod, $requestUri)) {
                    return $route;
                }
            }
        }

        return false;
    }



    /**
     * @param string $name
     * @param array $params
     * @return string|false
    */
    public function generate(string $name, array $params = [])
    {
        if(! $this->has($name)) {
            return false;
        }

        /** @var Route $route */
        $route = $this->namedRoutes[$name];

        return $route->convertParams($params);
    }



    /**
     * @param $name
     * @return bool
    */
    public function has($name): bool
    {
        return \array_key_exists($name, $this->getNamedRoutes());
    }


    /** Resolvers methods **/


    /**
     * resolve methods
     *
     * @param $methods
     * @return array
     */
    protected function resolveMethods($methods): array
    {
        if(is_string($methods)) {
            $methods = explode('|', $methods);
        }
        return (array) $methods;
    }



    /**
     * Resolve route path
     *
     * @param string $path
     * @return string
    */
    protected function resolvePath(string $path): string
    {
        if($prefix = $this->getOption(static::OPTION_PARAM_PATH_PREFIX)) {
            $path = rtrim($prefix, '/') . '/'. ltrim($path, '/');
        }
        return $path;
    }


    /**
     * Resolve handle
     *
     * @param $target
     * @return string
    */
    protected function resolveTarget($target): string
    {
        if(\is_string($target) && $namespace = $this->getOption(static::OPTION_PARAM_NAMESPACE)) {
            $target = rtrim(ucfirst($namespace), '\\') .'\\' . $target;
        }
        return $target;
    }



    /**
     * @param $name
     * @return string
    */
    protected function resolveName($name): string
    {
        if($prefixed = $this->getOption(static::OPTION_PARAM_NAME_PREFIX)) {
            return $prefixed . $name;
        }
        return $name;
    }



    /**
     * Get option by given param
     *
     * @param $key
     * @param null $default
     * @return mixed|void|null
    */
    protected function getOption($key, $default = null)
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
    */
    protected function removeOption($key)
    {
        unset($this->options[$key]);
    }



    /**
     * @param array $options
    */
    protected function addOptions(array $options)
    {
         $this->options = array_merge($this->options, $options);
    }


    /**
     * remove all options options
     *
     * @return void
    */
    protected function flushOptions()
    {
        $this->options = [];
    }


    /**
     * Flush all parameters
    */
    protected function flush()
    {
        $this->flushOptions();
        // ...
    }



    /**
     * @param $index
     * @return bool
    */
    protected function isValidOption($index): bool
    {
        return \in_array($index, $this->getAllowedOptionParams());
    }



    /**
     * @return string[]
    */
    protected function getAllowedOptionParams(): array
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
    protected function routeParameters(): array
    {
        return $this->resolvedRouteOptionParameters([
            self::KEY_OPTION_PARAM_PATH_PREFIX => $this->getOption(self::OPTION_PARAM_PATH_PREFIX),
            self::KEY_OPTION_PARAM_NAME_PREFIX => $this->getOption(self::OPTION_PARAM_NAME_PREFIX),
            self::KEY_OPTION_PARAM_NAMESPACE   => $this->getOption(self::OPTION_PARAM_NAMESPACE)
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