<?php

namespace Modules\Translation\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'translate',
        'locale',
        'translatable_id',
        'translatable_type',
    ];
    /**
     * scope translate
     *
     * @param string|null $locale
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeTranslate(Builder $query)
    {
        return $query->select(['translatable_id', 'translate'])->where('locale', \current_locale());
    }

    public function scopeAllTranslations(Builder $query)
    {
        return $query->select(['translatable_id', 'translate', 'locale']);
    }
}