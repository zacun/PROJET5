<?php
namespace niluap\core;

/**
 * Class Auth
 * @package niluap\core
 */
class Auth {

    public static function isAdmin() {
        return isset($_SESSION['admin']);
    }

}