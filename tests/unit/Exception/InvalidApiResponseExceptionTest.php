<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\GovPay\Exception\InvalidApiResponseException;
use Tests\Unit\AbstractTestCase;

class InvalidApiResponseExceptionTest extends AbstractTestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new InvalidApiResponseException('test error');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Invalid api response: test error", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}