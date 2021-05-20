<?php
namespace Jan\Component\Http;


use Jan\Component\Http\Bag\CookieBag;
use Jan\Component\Http\Bag\FileBag;
use Jan\Component\Http\Bag\HeaderBag;
use Jan\Component\Http\Bag\InputBag;
use Jan\Component\Http\Bag\ParameterBag;
use Jan\Component\Http\Bag\ServerBag;
use Jan\Component\Http\Session\Session;


/**
 * Class Request
 * @package Jan\Component\Http
 */
class Request
{


    /**
     * Get params from request get $_GET
     *
     * @var InputBag
     */
    public $queryParams;



    /**
     * Get params from request post $_POST
     *
     * @var InputBag
     */
    public $request;



    /**
     * Get attributes
     *
     * @var array
     */
    public $attributes = [];




    /**
     * Get parameters from cookies $_COOKIES
     * @var CookieBag
     */
    public $cookies;



    /**
     * Get parameters from request $_FILES
     *
     * @var FileBag
     */
    public $files;



    /**
     * server bag
     *
     * @var ServerBag
     */
    public $server;




    /**
     * headers
     *
     * @var HeaderBag
     */
    public $headers;




    /**
     * Parsed body
     *
     * @var string
     */
    public $content;



    /**
     * Get availables languages
     *
     * @var
     */
    public $languages;



    /**
     * Session
     */
    public $session;



    /**
     *  charset
     */
    public $charsets;



    /**
     * encodings
     *
     * @var
     */
    public $encodings;




    /**
     * @var
     */
    public $acceptableContentTypes;



    /**
     * Default locale
     * @var string
     */
    public $locale;




    /**
     * Default local language
     * @var string
     */
    public $defaultLocale = 'en';



    /**
     * request uri
     *
     * @var
     */
    protected $requestUri;



    /**
     * path info
     *
     * @var
     */
    protected $pathInfo;



    /**
     * Get base URL
     *
     * @var string
     */
    protected $baseUrl;




    /**
     * Get base path
     *
     * @var string
     */
    protected $basePath;




    /**
     * Request method
     */
    protected $method;



    /**
     * Format
     */
    protected $format = 'html';



    /**
     * Request constructor.
     * @param array $queryParams
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string|null $content
     */
    public function __construct(
        array $queryParams = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    )
    {
          $this->init($queryParams, $request, $attributes, $cookies, $files, $server, $content);
    }



    /**
     * @param array $queryParams
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string|null $content
    */
    public function init(
        array $queryParams = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    )
    {
        $this->queryParams = new InputBag($queryParams);
        $this->request     = new InputBag($request);
        $this->attributes  = new ParameterBag($attributes);
        $this->cookies     = new CookieBag($cookies);
        $this->files       = new FileBag($files);
        $this->server      = new ServerBag($server);
        $this->headers     = new HeaderBag($this->server->getHeaders());

        $this->content     = $content;
        $this->session     = new Session();
        $this->languages   = null;
        $this->charsets    = null;
        $this->encodings   = null;
        $this->acceptableContentTypes = null;
        $this->pathInfo    = null;
        $this->requestUri  = null;
        $this->baseUrl     = null;
        $this->basePath    = null;
        $this->method      = null;
        $this->format      = null;
    }




    /**
     * @param array $queryParams
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string|null $content
     * @return Request
     */
    public static function factory(
        array $queryParams = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    ): Request
    {
        return new static($queryParams, $request, $attributes, $cookies, $files, $server, $content);
    }



    /**
     * Request factory
     *
     * @return Request
     */
    public static function fromGlobals(): Request
    {
        $request =  static::factory($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);


        if($request->hasContentTypeFormUrlEncoded() &&
           $request->requestMethodIn(['PUT', 'DELETE', 'PATCH'])
        ) {
            parse_str($request->getContent(), $data);
            $request->request = new InputBag($data);
        }

        return $request;
    }


    /**
     * @param string $uri
     * @param string $method
     * @param array $parameters
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string|null $content
     * @return Request
    */
    public static function create(
        string $uri,
        string $method = 'GET',
        array $parameters = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    ): Request
    {

    }



    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }


    /**
     * @param string|null $content
     * @return Request
     */
    public function setContent(?string $content): Request
    {
        $this->content = $content;

        return $this;
    }


    /**
     * @param array $attributes
     * @return Request
     */
    public function setAttributes(array $attributes = []): Request
    {
        $this->attributes = $attributes;

        return $this;
    }


    /**
     * Get attribute
     * @param string $key
     * @return mixed
     */
    public function getAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }



    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }




    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        $https = $this->server->get('HTTPS');
        $port  = $this->server->get('SERVER_PORT');

        return $https == 'on' && $port == 443;
    }


    /**
     * @return bool
     */
    public function isXhr(): bool
    {
        return $this->server->get('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }


    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {

    }



    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->isSecure() ? 'https' : 'http:';
    }


    /**
     * @return bool
    */
    protected function hasContentTypeFormUrlEncoded(): bool
    {
        return stripos($this->headers->get('CONTENT_TYPE', ''), 'application/x-www-form-urlencoded') === 0;
    }



    /**
     * @param array $methods
     * @return bool
    */
    protected function requestMethodIn(array $methods)
    {
        return \in_array(strtoupper($this->server->get('REQUEST_METHOD', 'GET')), $methods);
    }

}