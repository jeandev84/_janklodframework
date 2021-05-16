<?php
namespace App\Controller;


use Jan\Component\Http\Response;
use Jan\Component\Templating\Renderer;

/**
 * Class PageController
 * @package App\Controller
*/
class PageController
{

       protected $view;

       protected $response;

       public function __construct(Renderer $view, Response $response)
       {
           $this->view = $view;
           $this->response = $response;
       }

       public function index()
       {
//           dump('Test');

           /*
            $this->response->setHeaders([
               'Content-Type' => 'application/json'
           ]);

           return \json_encode([
               'success' => true,
               'message' => 'home page loaded!'
           ]);
           */

           // $this->response->setStatus(301);
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


       public function userItems()
       {
           dump('Test');
           $this->response->setHeaders([
               'Content-Type' => 'application/json'
           ]);

           return \json_encode([
               'success' => true,
               'message' => 'home page loaded!'
           ]);
       }
}