<?php
namespace niluap\src\controllers;

use niluap\core\Alert;
use niluap\core\Controller;
use niluap\core\Mail;
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
        /***************/
        /* Contac Form */
        /***************/
        $name = '';
        $mail = '';
        $subject = '';
        $message = '';
        if (!empty($_POST)) {
            $name = trim($_POST['contact-name']);
            $mail = trim($_POST['contact-mail']);
            $subject = trim($_POST['contact-subject']);
            $message = trim($_POST['contact-message']);
            if (empty($name) || empty($mail) || empty($subject) || empty($message)) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error', 'alert');
            } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                Alert::setAlert('L\'adresse e-mail renseignée n\'est pas valide.', 'error', 'alert');
            } else {
                $subject = strip_tags($subject);
                $headers = 'FROM : ' . strip_tags($name) . ' <' . strip_tags($mail) . '>';
                $message = strip_tags($message);
                $send = new Mail('batpaulin@gmail.com');
                $send->newMail($subject, $message, $headers);
                exit();
            }
        }
        $this->render('home.twig', compact('lastAddedPosts', 'lastAddedProjects', 'name', 'mail', 'subject', 'message'));
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
            Alert::setAlert('Cet article n\'existe pas.', 'error', 'alert');
            $this->redirect(Router::getUrl('blog'));
        }
        $singlePost = $postsManager->getOnePost($_GET['id']);
        $commentsByPost = $commentsManager->getCommentsByPost($_GET['id']);
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

    public function postComment() {
        $commentsManager = new CommentsManager();
        $postExist = $commentsManager->exist('posts', $_GET['postId']);
        if (empty($postExist)) {
            Alert::setAlert('L\'article n\'existe pas.', 'error', 'alert');
            $this->redirect(Router::getUrl('blog'));
        }
        if (empty(trim($_POST['comment-author'])) || empty(trim($_POST['comment-content']))) {
            Alert::setAlert('Tous les champs ne sont pas remplis.', 'error', 'alert');
            $this->redirect(Router::getUrl('article') . '?id=' . $_GET['postId']);
        }
        $commentsManager->postComment(
            $_GET['postId'],
            ucfirst($_POST['comment-author']),
            $_POST['comment-content']
        );
        Alert::setAlert('Le commentaire a bien été posté et est en attente de modération.', 'success', 'alert');
        header('Location: ' . Router::getUrl('article') . '?id=' . $_GET['postId']);
    }


}