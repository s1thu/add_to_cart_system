<?php
namespace App\Models\DTOs;

class ProductDTO implements \JsonSerializable {
    private int $id;
    private string $name;
    private float $price;
    private string $image;

    public function __construct(int $id, string $name, float $price, string $image) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getImage(): string { return $this->image; }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image
        ];
    }
}