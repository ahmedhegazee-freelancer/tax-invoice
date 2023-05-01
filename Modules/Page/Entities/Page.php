<?php

namespace Modules\Page\Entities;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug',];


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
    }
    public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageTranslation::class)->translate();
    }
    public function allTranslations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageTranslation::class);
    }
}