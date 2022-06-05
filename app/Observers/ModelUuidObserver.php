<?php

namespace App\Observers;

use App\Models\ModelUuid;
use Ramsey\Uuid\Uuid;

class ModelUuidObserver
{
    /**
     * @param ModelUuid $model
     */
    public function creating(ModelUuid $model)
    {
        $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
    }
}
