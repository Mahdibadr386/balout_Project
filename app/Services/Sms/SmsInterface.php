<?php

namespace App\Services\Sms;

interface SmsInterface
{
    public function send(string $mobile, string $message): array;

    public function getName(): string;

}
