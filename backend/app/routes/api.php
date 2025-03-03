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
 * User Routes
 */
$router->map('GET', '/api/users', [UserController::class, 'getAllUsers']);
$router->map('GET', '/api/users/[i:id]', [UserController::class, 'getUserById']);
$router->map('POST', '/api/users', [UserController::class, 'createUser']);
$router->map('GET', '/api/users/[*:email]', [UserController::class, 'getUserByEmail']);

//Login
$router->map('POST', '/api/users/login', [UserController::class, 'login']);

/**
 * Cart Routes
 */
$router->map('GET', '/api/cart/[i:user_id]', [CartController::class, 'getCart']);
$router->map('POST', '/api/cart/add', [CartController::class, 'addToCart']);
$router->map('POST', '/api/cart/update', [CartController::class, 'updateCart']);
$router->map('POST', '/api/cart/remove', [CartController::class, 'removeFromCart']);
$router->map('POST', '/api/cart/clear', [CartController::class, 'clearCart']);
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