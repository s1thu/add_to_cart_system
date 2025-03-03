<?php
namespace App\Controllers;

use App\Services\UserService;
use App\Models\DTOs\UserDTO;
use App\Models\DTOs\LoginRequestDTO;

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
        
        $userDTO = new UserDTO(0, $data['username'], $data['email'], $data['password']);
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

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Email and password are required"]);
            return;
        }

        $dto = new LoginRequestDTO($data['email'], $data['password']);
        $user = $this->userService->login($dto);

        if (!$user) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid email or password"]);
            return;
        }

        // Store user ID in session for cart functionality
        $_SESSION['user_id'] = $user->getId();

        echo json_encode([
            "message" => "Login successful",
            "user" => $user
        ]);
    }
}