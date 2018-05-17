<?php
namespace niluap\src\models;

use niluap\core\Manager;

/**
 * Class UsersManager
 * @package niluap\src\models
 * Get/Set users information
 */
class UsersManager extends Manager {

    public function getUser($pseudo, $password) {
        $user = $this->prepare('SELECT * FROM users WHERE pseudo = ?', [$pseudo], true, true);
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        return $user;
    }

}