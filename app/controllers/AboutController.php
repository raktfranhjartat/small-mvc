<?php

class AboutController extends BaseController
{
    public function index()
    {
        $this->renderView('about/index', [
            'pageTitle' => 'About'
        ]);
    }
}