<?php
namespace niluap\src\controllers;

use niluap\core\Alert;
use niluap\core\Controller;
use niluap\core\Router;
use niluap\src\models\CommentsManager;
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
        $lastAddedProjects = $projectsManager->lastAddedProjects();
        $postsManager = new PostsManager();
        $lastAddedPosts = $postsManager->lastAddedPosts();
        $this->render('home.twig', compact('lastAddedPosts', 'lastAddedProjects'));
    }

    public function blogPage() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('blog.twig', compact('allPosts'));
    }

    public function singlePostPage() {
        $postsManager = new PostsManager();
        $commentsManager = new CommentsManager();
        $postExist = $postsManager->exist('posts', $_GET['id']);
        if (empty($postExist)) {
            Alert::setAlert('Cet article n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('blog'));
            exit();
        }
        $singlePost = $postsManager->getOnePost(htmlspecialchars($_GET['id']));
        $commentsByPost = $commentsManager->getCommentsByPost(htmlspecialchars($_GET['id']));
        $this->render('singlePost.twig', compact('singlePost', 'commentsByPost'));
    }

    public function portfolioPage() {
        $projectsManager = new ProjectsManager();
        $allProjects = $projectsManager->getAllProjects();
        $this->render('portfolio.twig', compact('allProjects'));
    }

    public function cvPage() {
        $this->render('cv.twig');
    }


}