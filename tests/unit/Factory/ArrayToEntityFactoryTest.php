<?php

declare(strict_types=1);

namespace Tests\Unit\Factory;

use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Enum\DateFormatEnum;
use LBHounslow\GovPay\Exception\EntityClassNotFoundException;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;
use LBHounslow\GovPay\Factory\ArrayToEntityFactory;
use Tests\Unit\AbstractTestCase;

class ArrayToEntityFactoryTest extends AbstractTestCase
{
    public function testItThrowsExceptionForInvalidEntityClassName()
    {
        $this->expectException(EntityClassNotFoundException::class);
        $arrayToEntityFactory = new ArrayToEntityFactory([], 'InvalidClassName');
        $arrayToEntityFactory->getClassInstanceFromString();
    }

    public function testItThrowsExceptionIfClassDoesNotImplementArrayToEntityInterface()
    {
        $this->expectException(InvalidEntityClassException::class);
        $arrayToEntityFactory = new ArrayToEntityFactory([], DateFormatEnum::class); // random class
        $arrayToEntityFactory->getClassInstanceFromString();
    }

    public function testItReturnsClassInstanceFromEntityClassNameWithNoData()
    {
        $result = (new ArrayToEntityFactory([], Payment::class))->factory();
        $this->assertInstanceOf(Payment::class, $result);
    }

    public function testItReturnsPopulatedClassInstanceFromEntityClassNameWithData()
    {
        $result = (new ArrayToEntityFactory(self::REFUND_ARRAY, Refund::class))->factory();
        $this->assertInstanceOf(Refund::class, $result);
        $this->assertEquals(self::REFUND_REFUND_ID, $result->getRefundId());
        $this->assertEquals(self::REFUND_CREATED_DATE, $result->getCreatedDate());
        $this->assertEquals(self::REFUND_AMOUNT, $result->getAmount());
        $this->assertEquals(self::REFUND_STATUS_SUCCESS, $result->getStatus());
        $this->assertEquals(self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettlementSummary()->getSettledDate());
    }
}