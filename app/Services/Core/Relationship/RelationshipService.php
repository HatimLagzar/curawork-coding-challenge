<?php

namespace App\Services\Core\Relationship;

use App\Models\Relationship;
use App\Models\User;
use App\Repositories\Relationship\RelationshipRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class RelationshipService
{
    private RelationshipRepository $relationshipRepository;
    private UserRepository $userRepository;

    public function __construct(RelationshipRepository $relationshipRepository, UserRepository $userRepository)
    {
        $this->relationshipRepository = $relationshipRepository;
        $this->userRepository         = $userRepository;
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
        $relationships = $this->relationshipRepository->getUserRelationships($user->getId());

        return $relationships->transform(function (Relationship $relationship) use ($user) {
            return $this->hydrate($user, $relationship);
        });
    }

    public function create(array $attributes): Relationship
    {
        $attributes = Arr::only($attributes, [
            Relationship::USER_ID_1_COLUMN,
            Relationship::USER_ID_2_COLUMN,
        ]);

        return $this->relationshipRepository->create($attributes);
    }

    private function hydrate(User $user, Relationship $relationship): Relationship
    {
        $relationship = $this->hydrateWithOtherUser($user, $relationship);

        $commonConnections = $this->getCommonRelationships($user, $relationship->getOtherUser());
        $commonConnections = $commonConnections->transform(function (Relationship $relationship) use ($user) {
            return $this->hydrateWithOtherUser($user, $relationship);
        });

        $relationship->setCommonConnections($commonConnections);

        return $relationship;
    }

    /**
     * @param  User  $user
     * @param  User  $otherUser
     *
     * @return Collection|Relationship[]
     */
    private function getCommonRelationships(User $user, User $otherUser): Collection|array
    {
        return $this->relationshipRepository->getCommonRelationships($user->getId(), $otherUser->getId());
    }

    public function hydrateWithOtherUser(User $user, Relationship $relationship): Relationship
    {
        $otherUser = $this->userRepository->findById($user->getId() === $relationship->getUserId1() ? $relationship->getUserId2() : $relationship->getUserId1());
        $relationship->setOtherUser($otherUser);

        return $relationship;
    }
}
