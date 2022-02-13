<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Entity\SettlementSummary;
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

    public function testSettersAndGetters()
    {
        $this->refund->setPaymentId('payment-id');
        $this->assertEquals('payment-id', $this->refund->getPaymentId());

        $this->refund->setRefundId('refund-id');
        $this->assertEquals('refund-id', $this->refund->getRefundId());

        $this->refund->setCreatedDate('2022-02-09');
        $this->assertEquals('2022-02-09', $this->refund->getCreatedDate());

        $this->refund->setAmount(123);
        $this->assertEquals(123, $this->refund->getAmount());

        $this->refund->setStatus('finished');
        $this->assertEquals('finished', $this->refund->getStatus());

        $this->refund->setSettlementSummary(new SettlementSummary());
        $this->assertInstanceOf(SettlementSummary::class, $this->refund->getSettlementSummary());
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->refund->fromArray([]);
        $this->assertInstanceOf(Refund::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectlyWithoutPayment()
    {
        $result = $this->refund->fromArray(self::REFUND_ARRAY_NO_PAYMENT_LINK);
        $this->assertEquals(self::REFUND_REFUND_ID, $result->getRefundId());
        $this->assertEquals('', $result->getPaymentId());
        $this->assertEquals(self::REFUND_CREATED_DATE, $result->getCreatedDate());
        $this->assertEquals(self::REFUND_AMOUNT, $result->getAmount());
        $this->assertEquals(self::REFUND_STATUS_SUCCESS, $result->getStatus());
        $this->assertEquals(self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettlementSummary()->getSettledDate());
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectlyWithPayment()
    {
        $result = $this->refund->fromArray(self::REFUND_ARRAY_WITH_PAYMENT_LINK);
        $this->assertEquals(self::REFUND_REFUND_ID, $result->getRefundId());
        $this->assertEquals(self::REFUND_PAYMENT_ID, $result->getPaymentId());
        $this->assertEquals(self::REFUND_CREATED_DATE, $result->getCreatedDate());
        $this->assertEquals(self::REFUND_AMOUNT, $result->getAmount());
        $this->assertEquals(self::REFUND_STATUS_SUCCESS, $result->getStatus());
        $this->assertEquals(self::REFUND_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettlementSummary()->getSettledDate());
    }
}