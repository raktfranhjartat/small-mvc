<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index()
    {
        $this->renderView('about/index', [
            'pageTitle' => 'About'
        ]);
    }
}