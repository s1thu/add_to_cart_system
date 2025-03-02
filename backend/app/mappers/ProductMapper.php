<?php
namespace App\Mappers;

use App\Models\Product;
use App\Models\DTOs\ProductDTO;

class ProductMapper {
    public static function toDTO(Product $product): ProductDTO {
        return new ProductDTO(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getImage()
        );
    }

    public static function toEntity(ProductDTO $dto): Product {
        return new Product(
            $dto->id,
            $dto->name,
            $dto->price,
            $dto->image
        );
    }
}