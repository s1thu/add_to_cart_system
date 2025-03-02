<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    public function index() {
        $product = new Product();
        $products = $product->getAllProducts();
        echo json_encode($products);
    }
}