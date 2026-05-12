<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $this->renderView('home/index', [
            'pageTitle' => 'Homepage'
        ]);
    }
}

