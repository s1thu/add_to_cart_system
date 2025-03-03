<?php
namespace App\Services;

use App\Repository\UserRepository;
use App\Models\DTOs\UserDTO;
use App\Mappers\UserMapper;

class UserService {
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    // ✅ Get all users
    public function getAllUsers(): array {
        $users = $this->userRepository->getAllUsers();
        return array_map(fn($user) => UserMapper::toDTO($user), $users);
    }

    // ✅ Get user by ID
    public function getUserById(int $id): ?UserDTO {
        $user = $this->userRepository->getUserById($id);
        return $user ? UserMapper::toDTO($user) : null;
    }

    // ✅ Create a new user
    public function createUser(UserDTO $userDTO): int {
        // Convert DTO to entity
        $userEntity = UserMapper::toEntity($userDTO);
        
        // Save user to repository
        return $this->userRepository->createUser($userEntity);
    }

    public function getUserByEmail(string $email): ?UserDTO {
        $user = $this->userRepository->getUserByEmail($email);
        return $user ? UserMapper::toDTO($user) : null;
    }
}