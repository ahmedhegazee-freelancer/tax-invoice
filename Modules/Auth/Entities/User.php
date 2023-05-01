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
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'password',
        'uuid',
        'mobile_token',
        'is_blocked',
        'profile_photo_path',
        'age_group_id',
        'age',
        'phone',
        'country_id',
        'date_of_birth',
        'instagram_account',
        'club_name',
        'country_code',
        'gender_id',
        'nationality_id',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'full_name',
        'gender'
    ];
    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
    }
    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getGenderAttribute()
    {
        return get_gender($this->gender_id);
    }
    public function isBlocked()
    {
        return $this->is_blocked;
    }
    public function cart(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function dependencies()
    {
        return $this->hasMany(Dependency::class);
    }
    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function messages()
    {
        return $this->hasMany(CustomerMessage::class);
    }
    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->where('locale', \current_locale())->latest();
    }
}