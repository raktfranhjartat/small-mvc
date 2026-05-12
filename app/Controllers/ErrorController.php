<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
    public function notFound()
    {
        http_response_code(404);

        $this->renderView('errors/404', [
            'pageTitle' => 'Page Not Found'
        ]);
    }

    public function viewNotFound()
    {
        http_response_code(500);

        $this->renderView('errors/500', [
            'pageTitle' => 'View Not Found'
        ]);
    }
}