<?php
namespace App\Controller;


use Jan\Component\Templating\Renderer;

/**
 * Class PageController
 * @package App\Controller
*/
class PageController
{

       protected $view;

       public function __construct(Renderer $view)
       {
           $this->view = $view;
       }

       public function index()
       {
           return $this->view->render('page/index.php');
       }


       public function about()
       {
           return $this->view->render('page/about.php');
       }


       public function contact()
       {
           return $this->view->render('page/contact.php');
       }
}