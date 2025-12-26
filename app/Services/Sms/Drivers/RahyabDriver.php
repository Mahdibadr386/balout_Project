<?php

namespace App\Services\Sms\Drivers;

use GuzzleHttp\Client;
use App\Services\Sms\SmsInterface;
use App\Services\Sms\Logger\SmsLoggerInterface;
use App\Services\Sms\Exceptions\SmsException;

class RahyabDriver implements SmsInterface
{
    protected Client $client;
    protected SmsLoggerInterface $logger;
    protected string $apiKey;
    protected string $baseUrl;
    protected string $driverName = 'rahyab';

    public function __construct(?string $apiKey, SmsLoggerInterface $logger)
    {
        $this->client = new Client([
            'timeout' => 10,
            'verify'  => false,
        ]);

        $this->logger = $logger;


        $this->apiKey = config('sms.drivers.rahyab.api_key') ?: 'dev';

        // URL از کانفیگ گرفته می‌شود
        $this->baseUrl = config('sms.drivers.rahyab.url');
    }

    public function send(string $mobile, string $message): array
    {
        try {
            $response = $this->client->post($this->baseUrl, [
                'form_params' => [
                    'api_key' => $this->apiKey,
                    'mobile'  => $mobile,
                    'message' => $message,
                ]
            ]);

            $body = $response->getBody()->getContents();
            $code = $response->getStatusCode();

            $this->logger->logSuccess(
                driver: $this->driverName,
                mobile: $mobile,
                message: $message,
                status: $code,
                response: $body
            );

            return [
                'success'  => true,
                'response' => $body,
                'status'   => $code,
            ];

        } catch (\Throwable $e) {

            $this->logger->logError(
                driver: $this->driverName,
                mobile: $mobile,
                message: $message,
                error: $e->getMessage()
            );

            throw new SmsException("خطا در ارسال پیامک: " . $e->getMessage());
        }
    }

    public function getName(): string
    {
        return $this->driverName;
    }
}
