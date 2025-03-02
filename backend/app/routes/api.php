<?php
require_once __DIR__ . '/../controllers/ProductController.php';

use App\Controllers\ProductController;

$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri == 'api/products') {
    $controller = new ProductController();
    $controller->getAllProducts();
}