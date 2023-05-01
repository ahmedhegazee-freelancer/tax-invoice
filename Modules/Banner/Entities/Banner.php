<?php

namespace Modules\Banner\Entities;

use App\Helpers\FormattedUrlAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{

    use HasFactory, FormattedUrlAttribute;
    const DISK = 'banners';
    protected $fillable = ['locale', 'url'];

    protected $appends = ['formatted_url'];
    public function scopeTranslate(Builder $query)
    {
        return $query->where('locale', \current_locale());
    }
}