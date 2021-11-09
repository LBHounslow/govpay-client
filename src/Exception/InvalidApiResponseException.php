<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Exception;

use Throwable;

class InvalidApiResponseException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            sprintf('Invalid api response: %s', $message),
            $code,
            $previous
        );
    }
}