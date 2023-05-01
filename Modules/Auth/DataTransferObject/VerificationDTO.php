<?php

namespace Modules\Auth\DataTransferObject;

class VerificationDTO
{
    public function __construct(
        public string $phone,
        public string $code,
        public string $action,
    ) {
    }
}