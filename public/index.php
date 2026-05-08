<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/AutoLoader.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Helpers.php';

$router = new Router();
$router->handleRequest($_SERVER['REQUEST_URI']);