<?php

namespace App\Services\Sms\Exceptions;

use Exception;

class SmsException extends Exception
{
    /**
     * SmsException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "SMS Service Error", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Create an exception from a failed SMS response
     *
     * @param mixed $response
     * @return static
     */
    public static function fromResponse($response)
    {
        $message = is_string($response) ? $response : json_encode($response);
        return new static("SMS failed: " . $message);
    }
}
