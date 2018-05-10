<?php
namespace niluap\src\controllers;

use niluap\core\Alert;
use niluap\core\Controller;
use niluap\core\Router;
use niluap\src\models\CommentsManager;
use niluap\src\models\PostsManager;
use niluap\src\models\ProjectsManager;

/**
 * Class AdminController
 * @package niluap\src\controllers
 * This class contains all function related to the admins such as displaying admin pages or allowing admin actions (delete comments/posts, add post/project, ...)
 */
class AdminController extends Controller {

    public function adminPage () {
        $commentsManager = new CommentsManager();
        $newComments = $commentsManager->getNewComments()->rowCount();
        if ($newComments > 0) {
            Alert::setAlert('Il y a de nouveaux commentaires à modérer.', 'info', 'notif');
        }
        $projectsManager = new ProjectsManager();
        $allProjects = $projectsManager->getAllProjects();
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('admin.twig', compact('allProjects', 'allPosts'));
    }

    public function commentsPage () {
        $commentsManager = new CommentsManager();
        $allComments = $commentsManager->getAllComments();
        $newComments = $commentsManager->getNewComments();
        $this->render('comments.twig', compact('allComments', 'newComments'));
    }

    public function acceptComment () {
        $commentsManager = new CommentsManager();
        $commentExist = $commentsManager->exist('comments', $_GET['id']);
        if (empty($commentExist)) {
            Alert::setAlert('Ce commentaire n\'existe pas.', 'error', 'alert');
            header('Location: ' . Router::getUrl('comments'));
            exit();
        }
        $commentsManager->acceptComment($_GET['id']);
        Alert::setAlert('Le commentaire a bien été accepté.', 'success', 'alert');
        header('Location: ' . Router::getUrl('comments'));
    }

    public function deleteComment () {
        $commentsManager = new CommentsManager();
        $commentExist = $commentsManager->exist('comments', $_GET['id']);
        if (empty($commentExist)) {
            Alert::setAlert('Ce commentaire n\'existe pas.', 'error', 'alert');
            header('Location: ' . Router::getUrl('comments'));
            exit();
        }
        $commentsManager->deleteComment($_GET['id']);
        Alert::setAlert('Le commentaire a bien été supprimé.', 'success', 'alert');
        header('Location: ' . Router::getUrl('comments'));
    }

    public function newPostPage () {
        $title = '';
        $content = '';
        if (!empty($_POST)) {
            $title = trim($_POST['new-post-title']);
            $content = trim($_POST['new-post-content']);
            if (empty($title) || empty($content)) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error', 'alert');
            } else {
                $postsManager = new PostsManager();
                $postsManager->newPost($title, $content);
                Alert::setAlert('L\'article a bien été ajouté.', 'success', 'alert');
                header('Location: ' . Router::getUrl('admin'));
                exit();
            }
        }
        $this->render('newPost.twig', compact('title', 'content'));
    }

    public function newProjectPage () {
        $this->render('newProject.twig');
    }

    public function editPostPage () {
        $postsManager = new PostsManager();
        $postExist = $postsManager->exist('posts', $_GET['id']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error', 'alert');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        if (!empty($_POST)) {
            if (empty(trim($_POST['edit-post-title'])) || empty(trim($_POST['edit-post-content']))) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error', 'alert');
            } else {
                $postsManager->editPost(
                    $_GET['id'],
                    $_POST['edit-post-title'],
                    $_POST['edit-post-content']
                );
                Alert::setAlert('Le chapitre a bien été mis à jour.', 'success', 'alert');
                header('Location: ' . Router::getUrl('article') . '?id=' . $_GET['id']);
                exit();
            }
        }
        $editPost = $postsManager->getOnePost($_GET['id']);
        $this->render('editPost.twig', compact('editPost'));
    }

    public function editProjectPage () {

    }

    public function deletePost () {
        $postManager = new PostsManager();
        $postExist = $postManager->exist('posts', $_GET['id']);
        if (empty($postExist)) {
            Alert::setAlert('Cet article n\'existe pas.', 'error', 'alert');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        $postManager->deletePost($_GET['id']);
        Alert::setAlert('L\'article a bien été supprimé.', 'success', 'alert');
        header('Location: ' . Router::getUrl('admin'));
    }

    public function deleteProject () {
        $projectsManager = new ProjectsManager();
        $projectExist = $projectsManager->exist('projects', $_GET['id']);
        if (empty($projectExist)) {
            Alert::setAlert('Ce projet n\'existe pas.', 'error', 'alert');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        $projectsManager->deleteProject($_GET['id']);
        Alert::setAlert('Le projet a bien été supprimé.', 'success', 'alert');
        header('Location: ' . Router::getUrl('admin'));
    }

}