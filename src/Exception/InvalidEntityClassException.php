<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Exception;

use Throwable;

class InvalidEntityClassException extends \Exception
{
    /**
     * @param string $entityClassName
     * @param string $entityInterface
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $entityClassName,
        string $entityInterface,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            vsprintf(
                '%s must implement %s', [
                $entityClassName,
                $entityInterface
            ]),
            $code,
            $previous
        );
    }
}
