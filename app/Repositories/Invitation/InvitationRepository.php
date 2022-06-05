<?php

namespace App\Repositories\Invitation;

use App\Models\Invitation;
use App\Repositories\AbstractEloquentRepository;

class InvitationRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Invitation
    {
        return $this->getQueryBuilder()
                    ->where(Invitation::ID_COLUMN, $id)
                    ->first();
    }

    public function create(array $attributes): Invitation
    {
        return $this->getQueryBuilder()
                    ->create($attributes);
    }

    protected function getModelClass(): string
    {
        return Invitation::class;
    }
}
