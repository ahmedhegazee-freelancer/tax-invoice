<?php

namespace Modules\Auth\DataTransferObject;

class SendOtpDTO
{

    public function __construct(public string $email, public $model)
    {
    }
}