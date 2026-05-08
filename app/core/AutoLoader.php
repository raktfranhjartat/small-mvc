<?php

spl_autoload_register(function ($className) {
    $paths = [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Om ingen fil hittas kan du logga det här:
    error_log("Autoloader: Kunde inte hitta klassfil för $className");
});