<?php
namespace App\Repository;

use App\Utils\Database;
use App\Models\Product;
use PDO;

class ProductRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllProducts(): array {
        $stmt = $this->db->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Product($row['id'], $row['name'], $row['price'], $row['image']), $products);
    }

    public function saveProduct(Product $product): void {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, image) VALUES (:name, :price, :image)");
        $stmt->execute([
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'image' => $product->getImage()
        ]);
    }
}