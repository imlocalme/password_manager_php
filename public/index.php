<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Config;
Config::load(__DIR__ . '/../.env');

session_set_cookie_params(['httponly'=>true,'secure'=>!empty($_SERVER['HTTPS']),'samesite'=>'Strict']);
session_start();

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self' https://cdn.jsdelivr.net");

$routes = require __DIR__ . '/../routes/api.php';
$key = $_SERVER['REQUEST_METHOD'] . ' ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!isset($routes[$key])) { http_response_code(404); echo json_encode(['error'=>'Not found']); exit; }
[$class,$method] = $routes[$key];
$controller = new $class();
header('Content-Type: application/json');
echo json_encode($controller->$method());
