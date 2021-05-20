<?php
namespace Jan\Foundation\Http;


use Jan\Component\Http\Request;
use Jan\Component\Http\Response;
use Jan\Contract\Http\Kernel as HttpKernelContract;
use Jan\Foundation\Application;


/**
 * Class Kernel
 * @package Jan\Foundation\Http
*/
class Kernel implements HttpKernelContract
{


    /**
     * @var Application
    */
    protected $app;


    /*
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    */


    /**
     * Kernel constructor.
    */
    public function __construct()
    {

    }


    /**
     * @param Request $request
     * @return Response
    */
    public function handle(Request $request): Response
    {

    }




    /**
     * @param Request $request
     * @param Response $response
     * @return mixed|void
    */
    public function terminate(Request $request, Response $response)
    {

    }
}