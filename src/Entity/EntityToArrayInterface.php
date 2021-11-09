<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

interface EntityToArrayInterface
{
    /**
     * @return array
     */
    public function toArray();
}
