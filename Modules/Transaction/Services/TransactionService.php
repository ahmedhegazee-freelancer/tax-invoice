<?php

namespace Modules\Transaction\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Entities\Coupon;
use Modules\Transaction\DataTransferObjects\TransactionCalculationDTO;
use Modules\Transaction\DataTransferObjects\TransactionDTO;
use Modules\Transaction\Entities\Transaction;
use Illuminate\Support\Str;

class TransactionService
{

    public function create(TransactionDTO $transactionDTO): Transaction
    {
        return DB::transaction(function () use ($transactionDTO) {
            $calculation = $this->calculate($transactionDTO);
            $transaction = Transaction::create([
                ...$calculation->toArray(),
                'coupon_code'   => $transactionDTO?->coupon?->code,
                'coupon_id'     => $transactionDTO?->coupon?->id,
                'user_id'       => $transactionDTO->customer->id,
                'customer_name'  => $transactionDTO->customer->full_name,
                'customer_phone'  => $transactionDTO->customer->phone,
                'status'        => 'accepted',
                'uuid'          => Str::ulid(),
            ]);

            return $transaction;
        });
    }
    public function calculate(TransactionDTO $transactionDTO)
    {
        $subtotal = 0;
        $total = 0;
        $discount = 0;
        $transactionDTO->tickets->each(function ($course) use (&$subtotal) {
            $subtotal += $course->price;
        });

        if (!is_null($transactionDTO->coupon)) {
            $total = $subtotal - $transactionDTO->coupon->amount;
            $discount = $transactionDTO->coupon->amount;
        } else {
            $total = $subtotal;
        }
        if ($total < 0)
            $total = 0;

        return new TransactionCalculationDTO($subtotal, $total, $discount);
    }
}