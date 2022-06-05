<?php

namespace App\Services\Core\Invitation;

use App\Models\Invitation;
use App\Repositories\Invitation\InvitationRepository;

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

    public function create(array $attributes): Invitation
    {
        return $this->invitationRepository->create($attributes);
    }
}
