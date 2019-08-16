<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function hello() {
        global $container;
        print_r($container->getParameter('sample'));die;

    }
}
