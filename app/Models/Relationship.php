<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relationship extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'relationships';

    public const ID_COLUMN = 'id';
    public const USER_ID_1_COLUMN = 'user_id1';
    public const USER_ID_2_COLUMN = 'user_id2';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $table = self::TABLE;
    protected $fillable = [
        self::USER_ID_1_COLUMN,
        self::USER_ID_2_COLUMN,
    ];

    protected $casts = [
        self::CREATED_AT_COLUMN => 'datetime',
        self::UPDATED_AT_COLUMN => 'datetime',
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getUserId1(): string
    {
        return $this->getAttribute(self::USER_ID_1_COLUMN);
    }

    public function getUserId2(): string
    {
        return $this->getAttribute(self::USER_ID_2_COLUMN);
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }
}
