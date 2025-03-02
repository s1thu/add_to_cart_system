<?php

use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\UserController;
use \AltoRouter;

$router = new AltoRouter();

/**
 * Product Routes
 */
$router->map('GET', '/api/products', [ProductController::class, 'getAllProducts']);
$router->map('POST', '/api/products', [ProductController::class, 'createProduct']);

/**
 * Cart Routes
 */
$router->map('POST', '/api/cart/add', [CartController::class, 'addToCart']);
$router->map('GET', '/api/cart/[i:userId]', [CartController::class, 'getCart']);
$router->map('PUT', '/api/cart/update', [CartController::class, 'updateCartItem']);
$router->map('DELETE', '/api/cart/remove/[i:cartId]', [CartController::class, 'removeCartItem']);
$router->map('DELETE', '/api/cart/clear/[i:userId]', [CartController::class, 'clearCart']);

/**
 * User Routes
 */
$router->map('GET', '/api/users', [UserController::class, 'getAllUsers']);
$router->map('GET', '/api/users/[i:id]', [UserController::class, 'getUserById']);
$router->map('POST', '/api/users', [UserController::class, 'createUser']);
$router->map('PUT', '/api/users/[i:id]', [UserController::class, 'updateUser']);
$router->map('DELETE', '/api/users/[i:id]', [UserController::class, 'deleteUser']);

/**
 * Handle Route Matching
 */
$match = $router->match();

if ($match) {
    [$controller, $method] = $match['target'];
    (new $controller())->$method(...array_values($match['params']));
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not Found"]);
}