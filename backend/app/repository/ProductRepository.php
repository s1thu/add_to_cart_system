<?php
namespace App\Repository;

use App\Utils\Database; 
use PDO;

class ProductRepository{

    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function getAllProducts(){
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}