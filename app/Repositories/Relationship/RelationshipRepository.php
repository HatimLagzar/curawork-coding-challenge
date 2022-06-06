<?php

namespace App\Repositories\Relationship;

use App\Models\Relationship;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class RelationshipRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Relationship
    {
        return $this->getQueryBuilder()
                    ->where(Relationship::ID_COLUMN, $id)
                    ->first();
    }

    public function create(array $attributes): Relationship
    {
        return $this->getQueryBuilder()
                    ->create($attributes);
    }

    /**
     * @param  string  $userId
     *
     * @return Relationship[]|Collection
     */
    public function getUserRelationships(string $userId): Collection|array
    {
        return $this->getQueryBuilder()
                    ->whereNot(Relationship::USER_ID_1_COLUMN, $userId)
                    ->whereNot(Relationship::USER_ID_2_COLUMN, $userId)
                    ->get();
    }

    /**
     * @param  string  $userId
     * @param  string  $otherUserId
     *
     * @return Relationship[]|Collection
     */
    public function getCommonRelationships(string $userId, string $otherUserId): Collection|array
    {
        $userRelationshipsIds = $this->getQueryBuilder()
                                     ->select(Relationship::USER_ID_1_COLUMN, Relationship::USER_ID_2_COLUMN)
                                     ->where(function ($query) use ($userId) {
                                         return $query->where(Relationship::USER_ID_1_COLUMN, $userId)
                                                      ->orWhere(Relationship::USER_ID_2_COLUMN, $userId);
                                     })
                                     ->whereNot(Relationship::USER_ID_1_COLUMN, $otherUserId)
                                     ->whereNot(Relationship::USER_ID_2_COLUMN, $otherUserId)
                                     ->get();

        $userRelationshipsIds = $userRelationshipsIds->transform(function (Relationship $item) use ($userId) {
            if ($item->getUserId1() === $userId) {
                return $item->getUserId2();
            }

            return $item->getUserId1();
        })->toArray();

        return $this->getQueryBuilder()
                    ->whereIn(Relationship::USER_ID_1_COLUMN, $userRelationshipsIds)
                    ->orWhereIn(Relationship::USER_ID_2_COLUMN, $userRelationshipsIds)
                    ->get();
    }

    protected function getModelClass(): string
    {
        return Relationship::class;
    }
}
