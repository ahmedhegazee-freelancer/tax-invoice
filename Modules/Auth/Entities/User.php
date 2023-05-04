<?php

namespace Modules\Auth\Entities;

use App\Helpers\HasProfilePhoto;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use Modules\AgeGroup\Entities\AgeGroup;
use Modules\Cart\Entities\Cart;
use Modules\CustomerMessage\Entities\CustomerMessage;
use Modules\Dependency\Entities\Dependency;
use Modules\Notification\Entities\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',

        'email',
        'password',

        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}