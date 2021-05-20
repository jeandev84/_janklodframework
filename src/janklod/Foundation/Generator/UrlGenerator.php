<?php
namespace Jan\Foundation\Generator;


use Jan\Component\Http\RequestContext;
use Jan\Component\Routing\Contract\UrlGeneratorInterface;
use Jan\Component\Routing\RouteCollection;


/**
 * Class UrlGenerator
 * @package Jan\Foundation\Generator
*/
class UrlGenerator implements UrlGeneratorInterface
{

     /**
      * @var RouteCollection
     */
     protected $routeCollection;


     /**
      * @var RequestContext
     */
     protected $requestContext;



     /**
      * UrlGenerator constructor.
      * @param RouteCollection $routeCollection
      * @param RequestContext $requestContext
     */
     public function __construct(RouteCollection $routeCollection, RequestContext $requestContext)
     {
          $this->routeCollection = $routeCollection;
          $this->requestContext = $requestContext;
     }


     /**
      * @return string
     */
     public function getAbsoluteUrl()
     {
         return $this->requestContext->getBaseUrl();
     }


     public function getAbsolutePath($path)
     {

     }


     public function getRelativePath($path)
     {
         // TODO implements
     }


     public function getNetworkPath($path)
     {
          // TODO implements
     }



     /**
      * @param string $name
      * @param array $parameters
      * @param int $referenceType
      * @return mixed|void
     */
     public function generate(string $name, array $parameters = [], int $referenceType = self::ABSOLUTE_URL)
     {
        // TODO: Implement generate() method.
     }



     /**
      * @param string $path
      * @param array $queryParams
      * @param string $fragment
      * @return string
     */
     public function generateUrl(string $path, array $queryParams = [], string $fragment = ''): string
     {
        return implode('/', [$this->getAbsoluteUrl(),
            trim($path, '\\/') . ($queryParams ? '?'. http_build_query($queryParams) : '') . $fragment
        ]);
     }


     /*
     public function generateUrlExample(string $path, array $queryParams = [], string $fragment = ''): string
     {
        return implode('/', [
            rtrim($this->getAbsoluteUrl(), '\\/'),
            trim($path, '\\/') . ($queryParams ? '?'. http_build_query($queryParams) : '') . $fragment
        ]);
     }
    */
}