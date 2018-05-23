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

        if (Auth::isAdmin()) {
            echo '<p class="info">Vous êtes déjà connectés.</p>';
            exit();
        }
        $usersManager = new UsersManager();
        $user = $usersManager->getUser($_POST['pseudo'], $_POST['password']);
        if (!$user) {
            echo '<p class="error">Identifiants incorrects.</p>';
        }
        if ($user['role'] === 'admin') {
            $_SESSION['admin'] = ['pseudo' => $user['pseudo']];
            echo '<p class="success">Connexion réussie.</p>';
        }
    }

    public function logout() {
        unset($_SESSION['admin']);
        echo '<p class="success">Déconnexion réussie.</p>';
    }

}