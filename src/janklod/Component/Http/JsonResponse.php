<?php
namespace Jan\Component\Http;


/**
 * Class JsonResponse
 * @package Jan\Component\Http
*/
class JsonResponse extends Response
{
    /**
     * @var string[]
    */
    protected $headers = ['Content-Type' => 'application/json'];


    /**
     * JsonResponse constructor.
     * @param null $content
     * @param int $status
     * @param array $headers
    */
    public function __construct($content = null, $status = 200, $headers = [])
    {
          $json = $content;
          if(\is_array($content)) {
              $json = json_encode($content);
          }

          if(json_last_error() != JSON_ERROR_NONE) {
              parent::__construct($json, $status, $headers);
          }
    }
}