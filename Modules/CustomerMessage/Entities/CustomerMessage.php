<?php

namespace Modules\CustomerMessage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Entities\User;

class CustomerMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}