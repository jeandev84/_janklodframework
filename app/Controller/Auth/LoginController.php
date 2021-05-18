<?php
namespace App\Controller\Auth;


use Jan\Component\Http\Request;
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


    public function index(Request $request)
    {
        if(! empty($_POST)) {
            // dump($_POST);
            dump($request->request->all());
        }

        return $this->view->render('auth/login.php');
    }
}