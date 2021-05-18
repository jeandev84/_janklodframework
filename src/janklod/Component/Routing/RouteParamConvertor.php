<?php
namespace Jan\Component\Routing;


/**
 * Class RouteParamConvertor
 * @package Jan\Component\Routing
*/
class RouteParamConvertor
{

     /**
      * @param $path
      * @param array $params
      * @return array|mixed|string|string[]|null
     */
     public function convertPath($path, $params = [])
     {
         if($params) {
             foreach($params as $k => $v)
             {
                 $path = preg_replace(["#{{$k}}#", "#{{$k}.?}#"], $v, $path);
             }
         }

         return $path;
     }


     /**
      * @return array
     */
     public function convertPatterns(array $patternParams)
     {
         $patterns = [];

         if($patternParams)
         {
             foreach ($patternParams as $name => $regex)
             {
                 $patterns[$name] = '(?P<'. $name .'>'. $regex . ')';
             }
         }

         return $patterns;
     }
}