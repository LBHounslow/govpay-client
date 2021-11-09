<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\GovPay\Exception\EntityClassNotFoundException;
use Tests\Unit\AbstractTestCase;

class EntityClassNotFoundExceptionTest extends AbstractTestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new EntityClassNotFoundException('EntityClassName');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Could not instantiate 'EntityClassName'", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}