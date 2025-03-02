<?php
namespace App\Mappers;

use App\Models\User;
use App\Models\DTOs\UserDTO;

class UserMapper {
    public static function toDTO(User $user): UserDTO {
        return new UserDTO(
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        );
    }

    public static function toEntity(UserDTO $userDTO): User {
        return new User(
            $userDTO->getId(),
            $userDTO->getUsername(),
            $userDTO->getEmail(),
            $userDTO->getPassword()
        );
    }
}