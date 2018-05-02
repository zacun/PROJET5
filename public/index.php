<?php
session_start();

define('BASE_URL', '/PROJET5');

use niluap\core\Router;

$router = new Router();
$router->dispatch();