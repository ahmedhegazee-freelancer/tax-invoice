<?php

namespace App\Helpers;

use Modules\Translation\Entities\Translation;

trait TranslationRelationship
{
    public function translations(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}