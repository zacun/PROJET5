<?php
namespace niluap\src\controllers;

use niluap\core\Alert;
use niluap\core\Auth;
use niluap\core\Controller;
use niluap\core\Router;
use niluap\src\models\UsersManager;

/**
 * Class AuthController
 * @package niluap\src\controllers
 * Contains function related to the login / logout of the admin
 * Can be used and extended for a space members.
 */
class AuthController extends Controller {

    public function login() {

        $usersManager = new UsersManager();
        $user = $usersManager->getUser($_POST['pseudo'], $_POST['password']);
        if (!$user) {
            echo 'wrong logins';
        }
        if ($user['role'] === 'admin') {
            if (Auth::isAdmin()) {
                echo 'already connected';
                exit();
            }
            $_SESSION['admin'] = ['pseudo' => $user['pseudo']];
            echo 'connection successful';
        }
    }

    public function logout() {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            echo 'logout successful';
        } else {
            echo 'not connected';
        }
    }

}