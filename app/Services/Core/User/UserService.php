<?php

namespace App\Services\Core\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return Collection|User[]
     */
    public function getSuggestions(User $user): Collection|array
    {
        return $this->userRepository->getSuggestions($user->getId());
    }

    public function findById(string $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}
