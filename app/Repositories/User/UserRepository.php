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
                    ->whereNot(User::ID_COLUMN, $userId)
                    ->whereNotExists(function ($db) use ($userId) {
                        $db->selectRaw(1)
                           ->from(Relationship::TABLE)
                           ->where(function ($db) use ($userId) {
                               $db->where(Relationship::USER_ID_1_COLUMN, $userId)
                                  ->orWhereRaw(Relationship::USER_ID_1_COLUMN.'='.sprintf('%s.%s', User::TABLE, User::ID_COLUMN));
                           })
                           ->where(function ($db) use ($userId) {
                               $db->where(Relationship::USER_ID_2_COLUMN, $userId)
                                  ->orWhereRaw(Relationship::USER_ID_2_COLUMN.'='.sprintf('%s.%s', User::TABLE, User::ID_COLUMN));
                           });
                    })
                    ->whereNotExists(function ($db) use ($userId) {
                        $db->selectRaw(1)
                           ->from(Invitation::TABLE)
                           ->where(function ($db) use ($userId) {
                               $db->where(Invitation::SENT_TO_COLUMN, $userId)
                                  ->whereRaw(Invitation::SENT_BY_COLUMN.'='.sprintf('%s.%s', User::TABLE, User::ID_COLUMN));
                           })
                           ->orWhere(function ($db) use ($userId) {
                               $db->where(Invitation::SENT_BY_COLUMN, $userId)
                                  ->whereRaw(Invitation::SENT_TO_COLUMN.'='.sprintf('%s.%s', User::TABLE, User::ID_COLUMN));
                           });
                    })
                    ->get();
    }

    protected function getModelClass(): string
    {
        return User::class;
    }
}
