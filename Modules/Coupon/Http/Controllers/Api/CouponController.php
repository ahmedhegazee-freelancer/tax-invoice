<?php

namespace Modules\Coupon\Http\Controllers\Api;

use App\Exceptions\CouponIsNotFoundException;
use App\Exceptions\CouponIsNotValidException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Coupon\Http\Requests\Api\CouponRequest;
use Modules\Coupon\Services\CouponService;
use Modules\Coupon\Transformers\CouponResource;

class CouponController extends Controller
{
    public function __invoke(CouponRequest $request)
    {
        $couponService = new CouponService();
        $coupon = $couponService->handle($request->get('coupon'));
        return new CouponResource($coupon);
    }
}