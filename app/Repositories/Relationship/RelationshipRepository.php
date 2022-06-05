<?php

namespace App\Repositories\Relationship;

use App\Models\Relationship;
use App\Repositories\AbstractEloquentRepository;

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

    protected function getModelClass(): string
    {
        return Relationship::class;
    }
}
