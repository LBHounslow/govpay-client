<?php

declare(strict_types=1);

namespace Tests\Unit\Enum;

use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use Tests\Unit\AbstractTestCase;

class HttpStatusCodeEnumTest extends AbstractTestCase
{
    public function testItConstructs()
    {
        $httpStatusCodeEnum = new HttpStatusCodeEnum();
        $this->assertInstanceOf(HttpStatusCodeEnum::class, $httpStatusCodeEnum);
    }
}