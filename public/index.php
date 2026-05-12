<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Helpers.php';

use App\Core\Router;

$router = new Router();
$router->handleRequest($_SERVER['REQUEST_URI']);