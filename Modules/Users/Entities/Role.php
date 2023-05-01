<?php

namespace Modules\Users\Entities;

use App\Models\Scopes\TeamScope;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{

    protected static function booted()
    {
    }
}
