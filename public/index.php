<?php
session_start();

define('BASE_URL', '/PROJET5');

require_once '../vendor/autoload.php';

use niluap\core\Router;

$router = new Router();
$router->dispatch();