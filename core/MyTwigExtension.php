<?php
namespace niluap\core;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig_Extension;
use Twig_Extension_GlobalsInterface;

class MyTwigExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface {

    public function getFilters() {
        return [
            new TwigFilter('getUrl', [$this, 'twigGetUrl']),
            new TwigFilter('getActiveMenu', [$this, 'twigGetActiveMenu'])
        ];
    }

    public function getFunctions() {
        return [
            new TwigFunction('getAlert', [$this, 'twigGetAlert'])
        ];
    }

    public function getGlobals() {
        return [
            'session' => $_SESSION
        ];
    }

    public function twigGetAlert($kind) {
        Alert::getAlert($kind);
    }

    public function twigGetUrl($route) {
        return Router::getUrl($route);
    }

    public function twigGetActiveMenu($url) {
        return Router::getActiveMenu($url);
    }

}