<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiException;
use Tests\Unit\AbstractTestCase;

class ApiExceptionTest extends AbstractTestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new ApiException(HttpStatusCodeEnum::BAD_REQUEST, 'error', '{"error":"body"}', 13);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals(HttpStatusCodeEnum::BAD_REQUEST, $result->getStatusCode());
        $this->assertEquals('{"error":"body"}', $result->getResponseBody());
        $this->assertEquals('error', $result->getMessage());
        $this->assertEquals(13, $result->getCode());
    }
}
