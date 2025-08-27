<?php

class Router {
    private array $routes = [];

    public function get(string $path, string $action) {
        $this->addRoute('GET', $path, $action);
    }

    public function post(string $path, string $action) {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute(string $method, string $path, string $action) {
        // Convert {id} → regex capture group
        $pattern = preg_replace('#\{([^/]+)\}#', '(?P<\1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        $this->routes[$method][$pattern] = $action;
    }

    public function dispatch(string $method, string $uri) {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (!isset($this->routes[$method])) {
            http_response_code(405);
            echo "Method not allowed";
            return;
        }

        foreach ($this->routes[$method] as $pattern => $action) {
            if (preg_match($pattern, $uri, $matches)) {
                [$controllerName, $methodName] = explode('@', $action);

                require_once __DIR__ . "/controller/{$controllerName}.php";
                $controller = new $controllerName();

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func_array([$controller, $methodName], $params);
            }
        }

        http_response_code(404);
        include __DIR__ . '/../views/error.php';
    }
}