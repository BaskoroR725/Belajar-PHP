<?php
require_once __DIR__ . '/controllers/AuthController.php';

$controller = new AuthController();

$route = $_GET['route'] ?? '/';
$route = trim($route);

$routes = [
    '/' => fn() => $controller->showHome(),
    '/login' => fn() => $controller->showLogin(),
    '/dashboard' => fn() => $controller->showDashboard(),
];

if (isset($routes[$route])) {
    $routes[$route]();
} else {
    http_response_code(404);
    echo '<h1>404 - Halaman tidak ditemukan</h1>';
}
