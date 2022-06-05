<?php

namespace App\Repositories\Relationship;

use App\Models\Relationship;
use App\Models\User;
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
                    ->whereNot(User::ID_COLUMN, $userId)
                    ->get();
    }

    protected function getModelClass(): string
    {
        return Relationship::class;
    }
}
