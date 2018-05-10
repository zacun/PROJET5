<?php
namespace niluap\core;

/**
 * Class Alert
 * @package niluap\core
 * This class is used to make alert/flash messages (success, errors, infos, ...) that will display wherever you want thanks to getAlert().
 * The $type on setAlert() will be use as a HTML/CSS class so that you just have to create it in your CSS file and customize it however you want to.
 */
class Alert {

    /**
     * @param string $message is the message that will be displayed.
     * @param string $type is the type as in declared in your CSS (error, success, info...)
     * @param string $kind name the session (alert, info, notif, ...)
     */
    public static function setAlert(string $message, string $type, string $kind) {
        $_SESSION[$kind] = ['message' => $message, 'type' => $type];
    }

    public static function getAlert($kind) {
        if (isset($_SESSION[$kind])) {
            echo '<div class="' . $kind . ' ' . $_SESSION[$kind]['type'] . '">' . $_SESSION[$kind]['message'] . '</div>';
            unset($_SESSION[$kind]);
        }
    }

}