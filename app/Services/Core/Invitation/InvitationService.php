<?php

namespace App\Services\Core\Invitation;

use App\Models\Invitation;
use App\Models\User;
use App\Repositories\Invitation\InvitationRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class InvitationService
{
    private InvitationRepository $invitationRepository;
    private UserRepository $userRepository;

    public function __construct(InvitationRepository $invitationRepository, UserRepository $userRepository)
    {
        $this->invitationRepository = $invitationRepository;
        $this->userRepository       = $userRepository;
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
        $invitations = $this->invitationRepository->getSentBy($user->getId());

        return $invitations->transform(function (Invitation $invitation) use ($user) {
            return $this->hydrate($invitation, $user);
        });
    }

    /**
     * @param  User  $user
     *
     * @return Collection|Invitation[]
     */
    public function getSentTo(User $user): Collection|array
    {
        $invitations = $this->invitationRepository->getSentTo($user->getId());

        return $invitations->transform(function (Invitation $invitation) use ($user) {
            return $this->hydrate($invitation, $user);
        });
    }

    public function create(array $attributes): Invitation
    {
        return $this->invitationRepository->create($attributes);
    }

    private function hydrate(Invitation $invitation, User $user): Invitation
    {
        $otherUser = $this->userRepository->findById($user->getId() === $invitation->getSentTo() ? $invitation->getSentBy() : $invitation->getSentTo());
        $invitation->setOtherUser($otherUser);

        return $invitation;
    }
}
