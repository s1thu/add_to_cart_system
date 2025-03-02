<?php
namespace App\Service;

use App\Repository\ProductRepository;

class ProductService{

    private $productRepository;

    public function __construct(){
        $this->productRepository = new ProductRepository();
    }

    public function getAllProducts(){
        return $this->productRepository->getAllProducts();
    }
}