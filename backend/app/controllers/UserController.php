<?php
namespace App\Controllers;

use App\Services\UserService;
use App\Models\DTOs\UserDTO;

class UserController {
    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    // ✅ Get all users (GET /api/users)
    public function getAllUsers() {
        $users = $this->userService->getAllUsers();
        echo json_encode($users);
    }

    // ✅ Get user by ID (GET /api/users/{id})
    public function getUserById($id) {
        $user = $this->userService->getUserById((int) $id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "User not found"]);
        }
    }

    // ✅ Create user (POST /api/users)
    public function createUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['username'], $data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }
        
        $userDTO = new UserDTO(0, $data['username'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT));
        $userId = $this->userService->createUser($userDTO);
        echo json_encode(["message" => "User created", "user_id" => $userId]);
    }

    // ✅ Get user by email (API endpoint)
    public function getUserByEmail(string $email) {
        $user = $this->userService->getUserByEmail($email);
        
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "User not found"]);
        }
    }
}