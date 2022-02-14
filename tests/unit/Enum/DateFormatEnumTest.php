<?php

declare(strict_types=1);

namespace Tests\Unit\Enum;

use LBHounslow\GovPay\Enum\DateFormatEnum;
use Tests\Unit\AbstractTestCase;

class DateFormatEnumTest extends AbstractTestCase
{
    public function testItConstructs()
    {
        $dateFormatEnum = new DateFormatEnum();
        $this->assertInstanceOf(DateFormatEnum::class, $dateFormatEnum);
    }
}