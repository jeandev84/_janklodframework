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

    public function __construct()
    {
        $this->view = new Renderer(__DIR__.'/../../../views');
    }

    public function index()
    {
        if(! empty($_POST)) {

            dd($_POST);
        }
        return $this->view->render('auth/login.php');
    }
}