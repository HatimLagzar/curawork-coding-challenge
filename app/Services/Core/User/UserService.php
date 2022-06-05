<?php

namespace App\Services\Core\User;

use App\Models\User;
use App\Repositories\User\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findById(string $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}
