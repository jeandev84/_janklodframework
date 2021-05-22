<?php
namespace Jan\Component\Http\Parser;


/**
 * Class UrlParser
 *
 * @package Jan\Component\Http\Parser
*/
class UrlParser
{

      /**
       * @var string
      */
      protected $url;


      /**
       * ParseUrlHelper constructor.
       * @param string $url
      */
      public function __construct(string $url)
      {
            $this->url = $url;
      }



      /**
       * @return mixed
      */
      public function getParses()
      {
          return parse_url($this->url);
      }


      /**
       * @param int $type
       * @return mixed
      */
      public function parse(int $type)
      {
          return parse_url($this->url, $type);
      }
}