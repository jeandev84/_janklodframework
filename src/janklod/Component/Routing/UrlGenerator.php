<?php
namespace Jan\Component\Routing;


/**
 * Class UrlGenerator
 * @package Jan\Component\Routing
*/
class UrlGenerator
{

//      const ABSOLUTE_PATH = 1;
//      const RELATIVE_PATH = 2;
//
//
//
//      /**
//       * @var Router
//      */
//      protected $router;
//
//
//
//      /**
//       * UrlGenerator constructor.
//       * @param Router $router
//      */
//      public function __construct($url, Router $router)
//      {
//            $this->router = $router;
//      }
//
//
//      /**
//       * @param string $name
//       * @param array $params
//       * @param int $depth
//       * @return false|string
//      */
//      public function generate(string $name, array $params = [], int $depth = 0)
//      {
//          $path =  $this->router->generate($name, $params);
//
//          switch ($depth) {
//              case static::ABSOLUTE_PATH:
//                  return $this->generateUrl($path);
//              break;
//              case static::RELATIVE_PATH:
//                  return $path;
//              break;
//          }
//
//          return $path;
//      }
//
//
//      /**
//       * @param string $path
//       * @param array $queryParams
//       * @param string $fragment
//       * @return string
//     */
//     public function generateUrl(string $path, array $queryParams = [], string $fragment = ''): string
//     {
//         return implode('/', [
//             rtrim($this->url, '\\/'),
//             trim($path, '\\/') . ($queryParams ? '?'. http_build_query($queryParams) : '') . $fragment
//         ]);
//     }
}