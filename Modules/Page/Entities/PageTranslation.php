<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'locale',
        'content',
        'title',
    ];
    public function scopeTranslate(Builder $query)
    {

        return $query->where('locale', \current_locale());
    }
}