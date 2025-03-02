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

    // ✅ Get all products
    public function getAllProducts(): array {
        $stmt = $this->db->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(fn($row) => new Product($row['id'], $row['name'], $row['price'], $row['image']), $products);
    }

    // ✅ Save a product and return the saved entity
    public function saveProduct(Product $product): Product {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, image) VALUES (:name, :price, :image)");
        $stmt->execute([
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'image' => $product->getImage()
        ]);

        // Fetch the last inserted product
        $id = $this->db->lastInsertId();
        return new Product($id, $product->getName(), $product->getPrice(), $product->getImage());
    }
}