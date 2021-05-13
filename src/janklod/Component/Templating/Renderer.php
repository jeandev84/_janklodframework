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
      protected $resourcePath;



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
       * @param string $targetPath
      */
      public function __construct(string $targetPath = '')
      {
           if($targetPath) {
               $this->resource($targetPath);
           }
      }


      /**
       * @param $resourcePath
       * @return $this
      */
      public function resource($resourcePath)
      {
          $this->resourcePath = rtrim($resourcePath, '\\/');

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
          require_once($this->resourcePath($this->template));
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
      public function getResource(string $filename)
      {
          $templatePath = $this->resourcePath($filename);

          if(! file_exists($templatePath)) {
              throw new ViewException(sprintf('view file %s does not exist!', $templatePath));
          }

          return $templatePath;
      }


      /**
       * @param string $template
       * @return string
       * @throws ViewException
      */
      public function resourcePath(string $template)
      {
          $templatePath = $this->targetResource . DIRECTORY_SEPARATOR . $this->resolvePath($template);

          if(! file_exists($templatePath)) {
              throw new ViewException(sprintf('view file %s does not exist!', $templatePath));
          }

          return $templatePath;
     }


     /**
      * @param $targetPath
      * @return string|string[]
     */
     protected function resolvePath($targetPath)
     {
         return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, ltrim($targetPath, '\\/'));
     }
}