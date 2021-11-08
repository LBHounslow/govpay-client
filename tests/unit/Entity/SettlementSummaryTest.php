<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\SettlementSummary;
use Tests\Unit\AbstractTestCase;

class SettlementSummaryTest extends AbstractTestCase
{
    /**
     * @var SettlementSummary
     */
    private $settlementSummary;

    public function setUp(): void
    {
        $this->settlementSummary = new SettlementSummary();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->settlementSummary->fromArray([]);
        $this->assertInstanceOf(SettlementSummary::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->settlementSummary->fromArray(
            [
                'capture_submit_time' => self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURE_SUBMIT_TIME,
                'captured_date' => self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURED_DATE,
                'settled_date' => self::PAYMENT_SETTLEMENT_SUMMARY_SETTLED_DATE,
            ]
        );
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURE_SUBMIT_TIME, $result->getCaptureSubmitTime());
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURED_DATE, $result->getCapturedDate());
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettledDate());
    }
}