<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

interface ArrayToEntityInterface
{
    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data);
}
