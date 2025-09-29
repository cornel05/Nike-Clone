<?php

class Router {
    private $routes = [];
    
    public function addRoute($method, $pattern, $controller, $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function get($pattern, $controller, $action) {
        $this->addRoute('GET', $pattern, $controller, $action);
    }
    
    public function post($pattern, $controller, $action) {
        $this->addRoute('POST', $pattern, $controller, $action);
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove /public from the URI if present
        $requestUri = preg_replace('#^/public#', '', $requestUri);
        
        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }
            
            $pattern = '#^' . $route['pattern'] . '$#';
            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                
                $controllerName = $route['controller'];
                $actionName = $route['action'];
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $actionName)) {
                        return call_user_func_array([$controller, $actionName], $matches);
                    }
                }
                
                $this->error404();
                return;
            }
        }
        
        $this->error404();
    }
    
    private function error404() {
        http_response_code(404);
        include __DIR__ . '/../app/views/layouts/404.php';
    }
}