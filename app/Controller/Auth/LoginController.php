<?php
namespace App\Controller\Auth;


use Jan\Component\Templating\Renderer;

/**
 * Class LoginController
 * @package App\Controller\Auth
*/
class LoginController
{
    protected $view;

    public function __construct(Renderer $view)
    {
         $this->view = $view;
    }


    public function index()
    {
        if(! empty($_POST)) {
            dump($_POST);
        }

        return $this->view->render('auth/login.php');
    }
}