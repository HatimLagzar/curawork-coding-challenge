<?php

namespace App\Services\Core\Invitation;

use App\Models\Invitation;
use App\Models\User;
use App\Repositories\Invitation\InvitationRepository;
use Illuminate\Database\Eloquent\Collection;

class InvitationService
{
    private InvitationRepository $invitationRepository;

    public function __construct(InvitationRepository $invitationRepository)
    {
        $this->invitationRepository = $invitationRepository;
    }

    public function findById(string $id): ?Invitation
    {
        return $this->invitationRepository->findById($id);
    }

    /**
     * @param  User  $user
     *
     * @return Collection|Invitation[]
     */
    public function getSentBy(User $user): Collection|array
    {
        return $this->invitationRepository->getSentBy($user->getId());
    }

    /**
     * @param  User  $user
     *
     * @return Collection|Invitation[]
     */
    public function getSentTo(User $user): Collection|array
    {
        return $this->invitationRepository->getSentTo($user->getId());
    }

    public function create(array $attributes): Invitation
    {
        return $this->invitationRepository->create($attributes);
    }
}
