<?php

namespace Modules\Transaction\DataTransferObjects;


use Modules\Auth\Entities\User;
use Modules\Coupon\Entities\Coupon;

class TransactionDTO
{

    public function __construct(
        public User $customer,
        public  $tickets,
        public ?Coupon $coupon
    ) {
    }
}