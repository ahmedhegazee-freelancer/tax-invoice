<?php

namespace Modules\Transaction\DataTransferObjects;

class TransactionCalculationDTO
{
    public function __construct(
        public int $subtotal,
        public int $total,
        public int $discount = 0
    ) {
    }
    public function toArray(): array
    {
        return [
            'total' => $this->subtotal,
            'paid' => $this->total,
            'discount' => $this->discount,
        ];
    }
}