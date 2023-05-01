<?php

namespace Modules\Auth\Services;

use App\Exceptions\InvalidOtp;
use App\Exceptions\VerificationCodeIsNotValid;
use App\Exceptions\VerificationCodeIsSent;
use App\Helpers\SMSService;
use Modules\Auth\DataTransferObject\VerificationDTO;
use Modules\Auth\Entities\Otp;

class OTPService
{

    public function send(string $phone, string $action)
    {
        $code = $this->find($phone, $action);
        if (!is_null($code) && $this->isValid($code)) {
            throw new VerificationCodeIsSent();
        }
        $code = (string)\generate_otp();

        // SMSService::send($phone, $code);
        return Otp::create([
            'phone' => $phone,
            'code' => (string)$code,
            'action' => $action,
            'expired_at' => now()->addMinutes(30),
        ]);
    }
    public function validate(VerificationDTO $dto)
    {
        $code = $this->findCode($dto);
        if (is_null($code)) {
            throw new InvalidOtp();
        }
        if (!$this->isValid($code))
            throw new VerificationCodeIsNotValid();
        $code->delete();
        return true;
    }
    public function find(string $phone, string $action): Otp|null
    {
        $code = Otp::where('phone', $phone)
            ->where('action', $action)
            ->latest()
            ->first();
        return $code;
    }
    public function findCode(VerificationDTO $dto)
    {
        return Otp::where('phone', $dto->phone)
            ->where('action', $dto->action)
            ->where('code', $dto->code)
            ->latest()
            ->first();
    }
    public function isValid(Otp $otp)
    {
        return now()->isBefore($otp->expired_at);
    }
    public function sendMail(string $email, string $code)
    {
        // Mail::to($email)->send(new VerifyEmailOTP(
        //     code: $code,
        // ));
    }
}
