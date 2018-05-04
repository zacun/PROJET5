<?php
session_start();

require_once '../vendor/autoload.php';

use niluap\core\Router;

$router = new Router();
$router->dispatch();