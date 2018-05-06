<?php
namespace niluap\core;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller {

    protected $viewsPaths = [
        'public' => __DIR__ . '/../views/public',
        'admin' => __DIR__ . '/../views/admin',
        'template' => __DIR__ . '/../views/template'
    ];
    private $twig;

    public function __construct() {
        $loader = new Twig_Loader_Filesystem($this->viewsPaths);
        $this->twig = new Twig_Environment($loader, []);
        $this->twig->addFilter($this->twigGetUrl());
        $this->twig->addFilter($this->twigGetActiveMenu());
        $this->twig->addFilter($this->twigGetExcerpt());
        $this->twig->addFunction($this->twigGetAlert());
    }

    /**
     * @param string $view
     * @param array $variables
     * render the right view with all needed variables.
     */
    public function render(string $view, $variables = []) {
        echo $this->twig->render($view, $variables);
    }

    /**
     * @param string $excerpt
     * @param int $length
     * @param bool $dot
     * @return bool|string
     * Make an excerpt from a text (comment, post, ...)
     */
    public static function getExcerpt(string $excerpt, int $length, bool $dot = true) {
        if ($dot == false) {
            return substr($excerpt, 0, $length);
        } else {
            return substr($excerpt, 0, $length) . '...';
        }
    }

    public function twigGetExcerpt() {
        return $newFilter = new TwigFilter('excerpt', function (string $excerpt, int $length, bool $dot = true) {
            return self::getExcerpt($excerpt, $length, $dot);
        });
    }

    public function twigGetAlert() {
        return $newFunction = new TwigFunction('getAlert', function () {
            Alert::getAlert();
        });
    }

    public function twigGetUrl() {
        return $newFilter = new TwigFilter('getUrl', function ($route) {
            return Router::getUrl($route);
        });
    }

    public function  twigGetActiveMenu() {
        return $newFilter = new TwigFilter('getActiveMenu', function ($url) {
            return Router::getActiveMenu($url);
        });
    }

}