<?php
namespace App\Repository;

use App\Utils\Database;
use App\Models\User;
use PDO;

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // ✅ Get all users
    public function getAllUsers(): array {
        $stmt = $this->db->query("SELECT * FROM users");
        $userDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log(print_r($userDatas, true));

        // Convert each array to a User object
        return array_map(fn($data) => new User(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['password']
        ), $userDatas);
    }

    // ✅ Get user by ID
    public function getUserById(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['password']
        ) : null;
    }

    // ✅ Fetch user by email
    public function getUserByEmail(string $email): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['password']
        );
    }

    // ✅ Create a new user
    public function createUser(User $user): int {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute([
            ':name' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => password_hash($user->getPassword(), PASSWORD_BCRYPT)
        ]);
        return $this->db->lastInsertId();
    }
}