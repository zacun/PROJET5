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
            echo '<p class="error">Identifiants incorrects.</p>';
        }
        if ($user['role'] === 'admin') {
            if (Auth::isAdmin()) {
                echo 2;
                exit();
            }
            $_SESSION['admin'] = ['pseudo' => $user['pseudo']];
            echo 1;
        }
    }

    public function logout() {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            echo 1;
        } else {
            echo '<p class="info">Vous n\'êtes pas connecté.</p>';
        }
    }

}