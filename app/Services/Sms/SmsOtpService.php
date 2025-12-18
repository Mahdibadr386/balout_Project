<?php

namespace App\Services\Sms;

use App\Models\SmsOtp;
use App\Services\Sms\Logger\SmsLoggerInterface;
use Illuminate\Support\Carbon;

class SmsOtpService
{
    protected SmsService $smsService;
    protected SmsLoggerInterface $logger;

    protected int $otpLength = 6;
    protected int $ttl = 300; // 5 minutes

    public function __construct(SmsService $smsService, SmsLoggerInterface $logger)
    {
        $this->smsService = $smsService;
        $this->logger = $logger;
    }

    public function sendOtp(string $phoneNumber): string
    {
        $otp = $this->generateOtp();
        $expiresAt = Carbon::now()->addSeconds($this->ttl);


        SmsOtp::where('phone_number', $phoneNumber)->delete();


        SmsOtp::create([
            'phone_number' => $phoneNumber,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        $minutes = (int) ($this->ttl / 60);
        $message = "کد تایید شما: {$otp} (اعتبار {$minutes} دقیقه)";


        $this->smsService->send($phoneNumber, $message);


        $this->logger->logSuccess(
            $this->smsService->getDriverName(),
            $phoneNumber,
            $message,
            200,
            'OTP sent successfully'
        );

        return $otp;
    }

    public function verifyOtp(string $phoneNumber, string $otp): bool
    {
        $record = SmsOtp::where('phone_number', $phoneNumber)->first();

        if (!$record) {
            $this->logger->logError(
                $this->smsService->getDriverName(),
                $phoneNumber,
                'OTP verification failed',
                'OTP record not found'
            );
            return false;
        }

        if ($record->expires_at->isPast()) {
            $record->delete();
            $this->logger->logError(
                $this->smsService->getDriverName(),
                $phoneNumber,
                'OTP verification failed',
                'OTP expired'
            );
            return false;
        }

        if (!hash_equals($record->otp, $otp)) {
            $this->logger->logError(
                $this->smsService->getDriverName(),
                $phoneNumber,
                'OTP verification failed',
                'OTP mismatch'
            );
            return false;
        }

        $record->delete();
        $this->logger->logSuccess(
            $this->smsService->getDriverName(),
            $phoneNumber,
            'OTP verified successfully',
            200,
            'OTP verified'
        );

        return true;
    }

    protected function generateOtp(): string
    {
        return (string) random_int(100000, 999999);
    }
}


