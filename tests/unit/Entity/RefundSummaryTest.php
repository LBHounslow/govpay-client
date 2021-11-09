<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\RefundSummary;
use Tests\Unit\AbstractTestCase;

class RefundSummaryTest extends AbstractTestCase
{
    /**
     * @var RefundSummary
     */
    private $refundSummary;

    public function setUp(): void
    {
        $this->refundSummary = new RefundSummary();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->refundSummary->fromArray([]);
        $this->assertInstanceOf(RefundSummary::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->refundSummary->fromArray(
            [
                'status' => self::PAYMENT_REFUND_SUMMARY_STATUS,
                'amount_available' => self::PAYMENT_REFUND_SUMMARY_AMOUNT_AVAILABLE,
                'amount_submitted' => self::PAYMENT_REFUND_SUMMARY_AMOUNT_SUBMITTED,
            ]
        );
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_STATUS, $result->getStatus());
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_AMOUNT_AVAILABLE, $result->getAmountAvailable());
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_AMOUNT_SUBMITTED, $result->getAmountSubmitted());
    }
}