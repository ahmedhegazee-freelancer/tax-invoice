<?php

namespace Modules\Coupon\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Http\Requests\Admin\StoreCouponRequest;
use Modules\Coupon\Http\Requests\Admin\UpdateCouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Coupons/Index', [
            'coupons' => Coupon::select(['id', 'code', 'amount', 'ended_at'])->latest()->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Coupons/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCouponRequest $request)
    {

        Coupon::create($request->validated());
        return  success_add('');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Coupon $coupon)
    {
        return
            Inertia::render('Coupons/Edit', [
                'model' => $coupon,
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return \success_update('');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return \success_delete('');
    }
}