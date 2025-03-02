<?php
namespace App\Controllers;

use PDO;
use App\Utils\Database;
use App\Service\ProductService;

class ProductController {

    private $productService;

    public function getAllProducts() {
        $productService = new ProductService();
        $products = $productService->getAllProducts();
        echo json_encode($products);
    }
}