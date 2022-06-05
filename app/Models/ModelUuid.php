<?php

namespace App\Models;

use App\Observers\ModelUuidObserver;
use Illuminate\Database\Eloquent\Model;

abstract class ModelUuid extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        self::observe(ModelUuidObserver::class);
    }
}
