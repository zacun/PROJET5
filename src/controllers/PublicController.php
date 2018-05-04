<?php
namespace niluap\src\controllers;

use niluap\core\Controller;
use niluap\src\models\PostsManager;
use niluap\src\models\ProjectsManager;

/**
 * Class PublicController
 * @package niluap\src\controllers
 * Contains functions related to public pages and actions (add comments, report comments, ...)
 */
class PublicController extends Controller {

    public function homePage() {
        $projectsManager = new ProjectsManager();
        $postsManager = new PostsManager();
        $lastAddedPosts = $postsManager->lastAddedPosts();
        $lastAddedProjects = $projectsManager->lastAddedProjects();
        $this->render('public/home', compact('lastAddedPosts', 'lastAddedProjects'));
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