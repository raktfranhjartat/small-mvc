<?php

class Router
{
    public function handleRequest(string $uri): void
    {
        $parsedUrl = parse_url($uri);
        $path = trim($parsedUrl['path'] ?? '/', '/');

        $segments = $path === '' ? [] : explode('/', $path);

        $controllerSegment = $segments[0] ?? 'home';

        
        $controllerName = str_replace(
                ' ',
                '',
                ucwords(str_replace('-', ' ', $controllerSegment))
            ) . 'Controller';

        $action = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);
        

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->notFound();
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->notFound();
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            $this->notFound();
            return;
        }

        // Säkerställ rätt antal parametrar
        $reflection = new ReflectionMethod($controller, $action);
        $expectedParams = $reflection->getNumberOfParameters();

        while (count($params) < $expectedParams) {
            $params[] = null;
        }

        call_user_func_array([$controller, $action], $params);
    }

    private function notFound(): void
    {
        require_once __DIR__ . '/../controllers/ErrorController.php';
        (new ErrorController())->notFound();
    }
}