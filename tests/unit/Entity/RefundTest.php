<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\Refund;
use Tests\Unit\AbstractTestCase;

class RefundTest extends AbstractTestCase
{
    /**
     * @var Refund
     */
    private $refund;

    public function setUp(): void
    {
        $this->refund = new Refund();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->refund->fromArray([]);
        $this->assertInstanceOf(Refund::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->refund->fromArray(self::REFUND_ARRAY);
        $this->assertEquals(self::REFUND_REFUND_ID, $result->getRefundId());
        $this->assertEquals(self::REFUND_CREATED_DATE, $result->getCreatedDate());
        $this->assertEquals(self::REFUND_AMOUNT, $result->getAmount());
        $this->assertEquals(self::REFUND_STATUS_SUCCESS, $result->getStatus());
        $this->assertEquals(self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettlementSummary()->getSettledDate());
    }
}