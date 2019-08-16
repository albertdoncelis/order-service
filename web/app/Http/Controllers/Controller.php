<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Controller extends BaseController
{
    //

    /**
     * @var ContainerBuilder
     */
    private $container;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;

    public function __construct()
    {
        
    }

    /**
     * @return ContainerBuilder
     */
    protected function container() {
        return $this->container;
    }
}
