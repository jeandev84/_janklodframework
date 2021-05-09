<?php
namespace Jan\Component\Templating;


use Jan\Component\Templating\Contract\RendererInterface;
use Jan\Component\Templating\Exception\ViewException;


/**
 * Class Renderer
 * @package Jan\Component\Templating
*/
class Renderer implements RendererInterface
{

      /**
       * view directory
       *
       * @var string
      */
      protected $resource;



      /**
       * file template
       *
       * @var string
      */
      protected $template;



      /**
       * view data
       *
       * @var array
      */
      protected $variables = [];



      /**
       * Renderer constructor.
       * @param string $resource
      */
      public function __construct(string $resource = '')
      {
           if($resource) {
               $this->resource($resource);
           }
      }


      /**
       * @param $resource
       * @return $this
      */
      public function resource($resource)
      {
          $this->resource = rtrim($resource, '\\/');

          return $this;
      }



      /**
       * @param array $variables
       * @return $this
      */
      public function setVariables(array $variables)
      {
          $this->variables = array_merge($this->variables, $variables);

          return $this;
      }


      /**
       * @param $template
       * @return $this
      */
      public function setTemplate($template)
      {
          $this->template = $template;

          return $this;
      }




      /**
       * Render view template and optional data
       *
       * @return false|string
       * @throws ViewException
      */
      public function renderHtml()
      {
          extract($this->variables, EXTR_SKIP);

          ob_start();
          require_once($this->getTemplate($this->template));
          return ob_get_clean();
      }



      /**
       * Render html template with availables variables
       *
       *  @param string $template
       *  @param array $variables
       *  @return false|string
       *  @throws ViewException
     */
     public function render($template, $variables = [])
     {
         return $this->setTemplate($template)
                     ->setVariables($variables)
                     ->renderHtml();
     }

      /**
       * @param string $filename
       * @return string
       * @throws ViewException
      */
      public function getTemplate(string $filename)
      {
          $template = $this->resourceTemplate($filename);

          if(! file_exists($template)) {
              throw new ViewException(sprintf('view file %s does not exist!', $template));
          }

          return $template;
      }


      /**
       * @param string $template
       * @return string
      */
      public function resourceTemplate(string $template)
      {
          return $this->resource . DIRECTORY_SEPARATOR . $this->resolveTemplatePath($template);
     }


     /**
      * @param $template
      * @return string|string[]
     */
     protected function resolveTemplatePath($template)
     {
         return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, ltrim($template, '\\/'));
     }
}