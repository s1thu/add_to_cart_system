<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri == 'api/products') {
    $controller = new ProductController();
    $controller->index();
}