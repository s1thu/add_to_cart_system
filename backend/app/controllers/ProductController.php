<?php
namespace App\Controllers;

use PDO;
use App\Utils\Database;
use App\Service\ProductService;

class ProductController {

    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function getAllProducts() {
        $products = $productService->getAllProducts();
        echo json_encode($products);
    }
}