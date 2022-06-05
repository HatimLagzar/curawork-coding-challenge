<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\AbstractEloquentRepository;

class UserRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?User
    {
        return $this->getQueryBuilder()
                    ->where(User::ID_COLUMN, $id)
                    ->first();
    }

    protected function getModelClass(): string
    {
        return User::class;
    }
}
