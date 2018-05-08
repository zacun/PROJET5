<?php
namespace niluap\src\controllers;

use niluap\core\Alert;
use niluap\core\Controller;
use niluap\core\Router;
use niluap\src\models\PostsManager;
use niluap\src\models\ProjectsManager;

/**
 * Class AdminController
 * @package niluap\src\controllers
 * This class contains all function related to the admins such as displaying admin pages or allowing admin actions (delete comments/posts, add post/project, ...)
 */
class AdminController extends Controller {

    public function adminPage () {
        $projectsManager = new ProjectsManager();
        $allProjects = $projectsManager->getAllProjects();
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('admin.twig', compact('allProjects', 'allPosts'));
    }

    public function commentsPage () {
        $this->render('comments.twig');
    }

    public function newPostPage () {
        $title = '';
        $content = '';
        if (!empty($_POST)) {
            $title = trim($_POST['new-post-title']);
            $content = trim($_POST['new-post-content']);
            if (empty($title) || empty($content)) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            } else {
                $postsManager = new PostsManager();
                $postsManager->newPost($title, $content);
                Alert::setAlert('L\'article a bien été ajouté.', 'success');
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
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        if (!empty($_POST)) {
            if (empty(trim($_POST['edit-post-title'])) || empty(trim($_POST['edit-post-content']))) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            } else {
                $postsManager->editPost(
                    $_GET['id'],
                    $_POST['edit-post-title'],
                    $_POST['edit-post-content']
                );
                Alert::setAlert('Le chapitre a bien été mis à jour.', 'success');
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
            Alert::setAlert('Cet article n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        $postManager->deletePost($_GET['id']);
        Alert::setAlert('L\'article a bien été supprimé.', 'success');
        header('Location: ' . Router::getUrl('admin'));
    }

    public function deleteProject () {

    }

}