<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Exception;

use Throwable;

class RepositoryNotFoundException extends \Exception
{
    /**
     * @param string $entityClass
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $entityClass,
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            sprintf("Cannot load repository class for entity '%s'", $entityClass),
            $code,
            $previous
        );
    }
}