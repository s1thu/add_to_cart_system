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

    // ✅ Update user (PUT /api/users/{id})
    public function updateUser($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['username'], $data['email'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }

        $userDTO = new UserDTO((int) $id, $data['username'], $data['email'], '');
        $updated = $this->userService->updateUser($userDTO);
        if ($updated) {
            echo json_encode(["message" => "User updated"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "User not found"]);
        }
    }

    // ✅ Delete user (DELETE /api/users/{id})
    public function deleteUser($id) {
        $deleted = $this->userService->deleteUser((int) $id);
        if ($deleted) {
            echo json_encode(["message" => "User deleted"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "User not found"]);
        }
    }
}