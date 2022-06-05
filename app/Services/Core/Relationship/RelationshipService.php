<?php

namespace App\Services\Core\Relationship;

use App\Models\Relationship;
use App\Models\User;
use App\Repositories\Relationship\RelationshipRepository;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @param  User  $user
     *
     * @return Collection|Relationship[]
     */
    public function getUserRelationships(User $user): Collection|array
    {
        return $this->relationshipRepository->getUserRelationships($user->getId());
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
