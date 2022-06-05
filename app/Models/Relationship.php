<?php

namespace App\Models;

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
}
