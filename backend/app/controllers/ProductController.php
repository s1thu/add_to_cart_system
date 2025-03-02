<?php
namespace App\Controllers;

use App\Models\DTOS\ProductDTO;
use App\Services\ProductService;
use App\Mappers\ProductMapper;

class ProductController {
    private ProductService $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function getAllProducts() {
        $products = $this->productService->getAllProducts();
        $productDTOs = array_map(fn($product) => ProductMapper::toDTO($product), $products);
        error_log(print_r($productDTOs, true));
        echo json_encode($productDTOs);
    }

    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name']) || !isset($data['price']) || !isset($data['image'])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        $productDTO = new ProductDTO(0, $data['name'], (float) $data['price'], $data['image']);
        $product = ProductMapper::toEntity($productDTO);
        
        $this->productService->saveProduct($product);

        http_response_code(201);
        echo json_encode(["message" => "Product created successfully"]);
    }
}