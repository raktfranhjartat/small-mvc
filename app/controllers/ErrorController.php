<?php

class ErrorController extends BaseController
{
    public function notFound()
    {
        http_response_code(404);

        $this->renderView('errors/404', [
            'pageTitle' => 'Page Not Found'
        ]);
    }
}