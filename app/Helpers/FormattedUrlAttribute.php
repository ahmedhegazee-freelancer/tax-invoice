<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

trait FormattedUrlAttribute
{
    public function getUrlFieldAttribute()
    {
        return
            defined(get_class($this) . '::URL_ATTRIBUTE') ? self::URL_ATTRIBUTE : 'url';;
    }
    public function getDisk()
    {
        return
            \str_contains($this[$this->getUrlFieldAttribute()], 'default') ? 'default' : self::DISK;
    }
    public function getFormattedUrlAttribute()
    {
        return Storage::disk($this->getDisk())->url($this[$this->getUrlFieldAttribute()]);
    }
    protected static function booted()
    {
        static::deleted(function ($model) {
            if ($model->getDisk() != 'default')
                Storage::disk($model->getDisk())->delete($model->url);
        });
    }
}