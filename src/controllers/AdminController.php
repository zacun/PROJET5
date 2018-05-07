<?php
namespace niluap\src\controllers;

use niluap\core\Controller;
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

}