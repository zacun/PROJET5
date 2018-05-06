<?php
namespace niluap\core;

use Twig_Environment;
use Twig_Extensions_Extension_Text;
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
        $this->twig = new Twig_Environment($loader, [
            'cache' => false
        ]);
        $this->twig->addExtension(new Twig_Extensions_Extension_Text());
        $this->twig->addExtension(new MyTwigExtension());
    }

    /**
     * @param string $view
     * @param array $variables
     * render the right view with all needed variables.
     */
    public function render(string $view, $variables = []) {
        echo $this->twig->render($view, $variables);
    }

}