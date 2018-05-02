<?php
namespace niluap\core;

/**
 * Class Alert
 * @package niluap\core
 * This class is used to make alert/flash messages (success, errors, infos, ...) that will display wherever you want thanks to getAlert().
 * The $type on setAlert() will be use as a HTML/CSS class so that you just have to create it in your CSS file and customize it however you want to.
 */
class Alert {

    public static function setAlert(string $message, string $type) {
        $_SESSION['alert'] = ['message' => $message, 'type' => $type];
    }

    public static function getAlert() {
        if (isset($_SESSION['alert'])) {
            echo '<div class="alert ' . $_SESSION['alert']['type'] . '">' . $_SESSION['alert']['message'] . '</div>';
            unset($_SESSION['alert']);
        }
    }

}