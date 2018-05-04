<?php
namespace niluap\core;

class Controller {

    protected $viewPath = '../views/';
    protected $template = 'default';

    /**
     * @param string $view
     * @param array $variables
     * render the right view with all needed variables.
     */
    public function render(string $view, $variables = []) {
        extract($variables);
        ob_start();
        $title = '';
        require($this->viewPath . $view .'.php');
        $content = ob_get_clean();
        require($this->viewPath . 'template/' . $this->template . '.php');
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

}