<?php

namespace Modules\Coupon\Services;

use App\Exceptions\CouponIsNotFoundException;
use App\Exceptions\CouponIsNotValidException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Coupon\Entities\Coupon;

class CouponService
{
    public function find(string $code): Coupon|null
    {
        return Coupon::firstWhere('code', $code);
    }
    public function isValid(Coupon $coupon): bool
    {
        return now()->isBefore($coupon->ended_at);
    }
    public function handle(string $code)
    {
        $coupon = $this->find($code);
        if (is_null($coupon))
            throw new CouponIsNotFoundException();
        if (!$this->isValid($coupon)) {
            throw new CouponIsNotValidException();
        }
        return $coupon;
    }
}