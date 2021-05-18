<?php
namespace Jan\Component\Routing\Contract;


/**
 * Interface ParameterConvertorContract
 * @package Jan\Component\Routing\Contract
*/
interface ParameterConvertorContract
{
     public function convertPatterns($patterns);
     public function convertPath($path, $params);
}