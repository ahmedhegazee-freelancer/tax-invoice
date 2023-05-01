<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Entities\User;
use Modules\Booking\Entities\Booking;
use Modules\Coupon\Entities\Coupon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'payment_no',
        'total',
        'paid',
        'discount',
        'status',
        'coupon_id',
        'coupon_code',
        'customer_name',
        'customer_phone',
    ];
    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
    public function scopeAccepted(Builder $query)
    {
        return $query->where('status', 'accepted');
    }
}