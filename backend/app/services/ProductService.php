<?php
namespace App\Services;

use App\Repository\ProductRepository;
use App\Models\Product;

class ProductService {
    private ProductRepository $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    public function getAllProducts(): array {
        return $this->productRepository->getAllProducts();
    }

    public function saveProduct(Product $product): void {
        $this->productRepository->saveProduct($product);
    }
}