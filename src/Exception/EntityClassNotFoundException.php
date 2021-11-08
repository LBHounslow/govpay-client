<?php

namespace LBHounslow\GovPay\Exception;

use Throwable;

class EntityClassNotFoundException extends \Exception
{
    /**
     * @param string $entityClassName
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $entityClassName,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            sprintf("Could not instantiate '%s'", $entityClassName),
            $code,
            $previous
        );
    }
}