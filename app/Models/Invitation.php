<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'invitations';

    public const ID_COLUMN = 'id';
    public const SENT_BY_COLUMN = 'sent_by';
    public const SENT_TO_COLUMN = 'sent_to';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $table = self::TABLE;
    protected $fillable = [
        self::SENT_BY_COLUMN,
        self::SENT_TO_COLUMN,
    ];

    protected $casts = [
        self::CREATED_AT_COLUMN => 'datetime',
        self::UPDATED_AT_COLUMN => 'datetime',
    ];

    private ?User $otherUser = null;

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getSentBy(): string
    {
        return $this->getAttribute(self::SENT_BY_COLUMN);
    }

    public function getSentTo(): string
    {
        return $this->getAttribute(self::SENT_TO_COLUMN);
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }

    public function getOtherUser(): ?User
    {
        return $this->otherUser;
    }

    public function setOtherUser(?User $otherUser): self
    {
        $this->otherUser = $otherUser;

        return $this;
    }
}
