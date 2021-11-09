<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\GovPay\Entity\EntityToArrayInterface;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;
use LBHounslow\GovPay\Response\ApiResponse;
use Tests\Unit\AbstractTestCase;

class InvalidEntityClassExceptionTest extends AbstractTestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new InvalidEntityClassException(ApiResponse::class, EntityToArrayInterface::class);
        $errorMessage = vsprintf("%s must implement %s", [ApiResponse::class, EntityToArrayInterface::class]);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals($errorMessage, $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}