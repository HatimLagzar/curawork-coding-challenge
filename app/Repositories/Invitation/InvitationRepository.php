<?php

namespace App\Repositories\Invitation;

use App\Models\Invitation;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param  string  $userId
     *
     * @return Collection|Invitation[]
     */
    public function getSentBy(string $userId): Collection|array
    {
        return $this->getQueryBuilder()
                    ->where(Invitation::SENT_BY_COLUMN, $userId)
                    ->get();
    }

    /**
     * @param  string  $userId
     *
     * @return Collection|Invitation[]
     */
    public function getSentTo(string $userId): Collection|array
    {
        return $this->getQueryBuilder()
                    ->where(Invitation::SENT_TO_COLUMN, $userId)
                    ->get();
    }

    protected function getModelClass(): string
    {
        return Invitation::class;
    }
}
