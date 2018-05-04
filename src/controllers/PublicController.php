<?php
namespace niluap\src\controllers;

use niluap\core\Controller;

/**
 * Class PublicController
 * @package niluap\src\controllers
 * Contains functions related to public pages and actions (add comments, report comments, ...)
 */
class PublicController extends Controller {

    public function homePage() {
        $this->render('public/home');
    }

    public function blogPage() {
        $this->render('public/blog');
    }

    public function portfolioPage() {
        $this->render('public/portfolio');
    }

    public function cvPage() {
        $this->render('public/cv');
    }


    public function singlePostPage() {
        $this->render('public/singlePost');
    }

}