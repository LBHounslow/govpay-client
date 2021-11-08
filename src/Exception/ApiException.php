<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Exception;

use Throwable;

class ApiException extends \Exception
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @param int $statusCode
     * @param string $message
     * @param string $responseBody
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        int $statusCode,
        string $message = '',
        string $responseBody = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }
}
