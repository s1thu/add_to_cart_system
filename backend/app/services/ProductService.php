<?php
namespace App\Services;

use App\Repository\ProductRepository;
use App\Models\DTOs\ProductDTO;
use App\Mappers\ProductMapper;

class ProductService {
    private ProductRepository $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    // ✅ Get all products (Returns Entity List)
    public function getAllProducts(): array {
        return $this->productRepository->getAllProducts();
    }

    // ✅ Save a product (Uses DTO and Converts it)
    public function saveProduct(ProductDTO $productDTO): ProductDTO {
        $productEntity = ProductMapper::toEntity($productDTO); // Convert DTO to Entity
        $savedProduct = $this->productRepository->saveProduct($productEntity);
        return ProductMapper::toDTO($savedProduct); // Convert back to DTO
    }
}