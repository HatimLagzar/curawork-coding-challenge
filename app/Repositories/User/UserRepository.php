<?php

namespace App\Repositories\User;

use App\Models\Invitation;
use App\Models\Relationship;
use App\Models\User;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?User
    {
        return $this->getQueryBuilder()
                    ->where(User::ID_COLUMN, $id)
                    ->first();
    }

    /**
     * @return Collection|User[]
     */
    public function getSuggestions(string $userId): Collection|array
    {
        return $this->getQueryBuilder()
                    ->whereNotExists(function ($db) use ($userId) {
                        $db->selectRaw(1)
                           ->from(Relationship::TABLE)
                           ->where(Relationship::USER_ID_1_COLUMN, $userId)
                           ->orWhere(Relationship::USER_ID_2_COLUMN, $userId);
                    })
                    ->whereNotExists(function ($db) use ($userId) {
                        $db->selectRaw(1)
                           ->from(Invitation::TABLE)
                           ->where(Invitation::SENT_TO_COLUMN, $userId)
                           ->orWhere(Invitation::SENT_BY_COLUMN, $userId);
                    })
                    ->get();
    }

    protected function getModelClass(): string
    {
        return User::class;
    }
}
