<?php

namespace App\Services\Sms;

class SmsService
{
    protected SmsManager $manager;

    public function __construct(SmsManager $manager)
    {
        $this->manager = $manager;
    }

    public function send(string $mobile, string $message): array
    {
        return $this->manager->driver()->send($mobile, $message);
    }

    /**
     * Get the current active driver name
     */
    public function getDriverName(): string
    {
        return $this->manager->driver()->getName();
    }
}
