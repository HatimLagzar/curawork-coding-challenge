<?php

namespace App\Services\Core\Relationship;

use App\Models\Relationship;
use App\Repositories\Relationship\RelationshipRepository;
use Illuminate\Support\Arr;

class RelationshipService
{
    private RelationshipRepository $relationshipRepository;

    public function __construct(RelationshipRepository $relationshipRepository)
    {
        $this->relationshipRepository = $relationshipRepository;
    }

    public function findById(string $id): ?Relationship
    {
        return $this->relationshipRepository->findById($id);
    }

    public function create(array $attributes): Relationship
    {
        $attributes = Arr::only($attributes, [
            Relationship::USER_ID_1_COLUMN,
            Relationship::USER_ID_2_COLUMN,
        ]);

        return $this->relationshipRepository->create($attributes);
    }
}
