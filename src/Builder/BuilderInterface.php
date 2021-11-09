<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Builder;

interface BuilderInterface
{
    /**
     * @return mixed
     */
    public function build();
}