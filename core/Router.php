<?php
namespace niluap\core;
/**
 * Class Router
 * @package niluap\core
 * Simple Router of this website.
 * The routes are stocked in a .json file.
 */
class Router {

    private static $routes;

    public function __construct() {
        $this->getRoutes();
    }

    /**
     * Read routes.json and convert it to php array.
     */
    private function getRoutes() {
        $json_file = file_get_contents('../core/routes.json');
        $jsonToArray = json_decode($json_file, true);
        self::$routes = $jsonToArray;
    }

    /**
     * @return mixed|string
     * Get a path needed for dispatch() function
     */
    private function getPath() {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace(BASE_URL, '', $url);
        $url = strtok($url, '?');
        return $url;
    }

    /**
     * Main function of this Router.
     * Depending on returned result of getPath(),
     * it will chose which Controller & method is needed.
     */
    public function dispatch() {
        $path = $this->getPath();
        foreach (self::$routes as $key => $values) {
            if ($path == $values['path']) {
                $controllerAndMethod = explode('@', $values['run']);
                break;
            }
        }
        if (!isset($controllerAndMethod)) {
            Alert::setAlert('L\'adresse demandée n\'existe pas.', 'error');
            header('Location: ' . BASE_URL . '/');
            exit();
        }
        $controller = $controllerAndMethod[0];
        $method = $controllerAndMethod[1];
        $controller = 'niluap\src\controllers\\' . $controller;
        $controllerClass = new $controller;
        $controllerClass->$method();
    }

    /**
     * @param string $route
     * @return string
     * Generate an URL depending on the needed route
     */
    public static function getUrl(string $route) {
        $url = BASE_URL . self::$routes[$route]['path'];
        return $url;
    }
}