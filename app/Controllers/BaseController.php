<?php

namespace App\Controllers;

use App\Controllers\ErrorController;

class BaseController
{

    public function __construct() {   
        date_default_timezone_set('Europe/Stockholm');
        setlocale(LC_TIME, 'sv_SE.UTF-8');
        mb_internal_encoding("UTF-8");
        
    }

    protected function renderView(string $view, array $data = [], string $layout = 'app')
    {
        extract($data, EXTR_SKIP);

        $layoutFile = __DIR__ . "/../views/layout/{$layout}.view.php";
        $viewFile   = __DIR__ . "/../views/{$view}.view.php";

        if (!file_exists($viewFile)) {
            (new ErrorController())->viewNotFound();
            
            return;
        }

        require $layoutFile;
    }

    protected function redirect(string $url, array $flash = []): void
    {
        if ($flash) {
            $_SESSION['flash'] = $flash;
        }

        if (!headers_sent()) {
            header('Location: ' . $url);
        }

        exit;
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}