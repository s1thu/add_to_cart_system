<?php
namespace App\Controllers;

use App\Models\DTOs\ProductDTO;
use App\Services\ProductService;
use App\Mappers\ProductMapper;

class ProductController {
    private ProductService $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    // ✅ Get all products
    public function getAllProducts() {
        $products = $this->productService->getAllProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    // ✅ Create a new product
    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate input
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['image'])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        // Create DTO and pass it to service
        $productDTO = new ProductDTO(0, $data['name'], (float) $data['price'], $data['image']);
        $savedProductDTO = $this->productService->saveProduct($productDTO);

        http_response_code(201);
        echo json_encode(["message" => "Product created successfully", "product" => $savedProductDTO]);
    }
}