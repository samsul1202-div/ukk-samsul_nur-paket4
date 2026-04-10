<?php

class Router
{
    protected $controller = 'Dashboard';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Check if controller file exists
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]);
            $controllerFile = __DIR__ . '/../Controllers/' . $controllerName . '.php';
            
            // Check if regular controller exists
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                // Check if controller with "Controller" suffix exists
                $controllerFileWithSuffix = __DIR__ . '/../Controllers/' . $controllerName . 'Controller.php';
                if (file_exists($controllerFileWithSuffix)) {
                    $this->controller = $controllerName . 'Controller';
                    unset($url[0]);
                }
            }
        }

        // Check if method exists
        if (!empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get remaining params
        $this->params = array_values($url);

        // Instantiate controller
        $this->controller = new $this->controller();
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
