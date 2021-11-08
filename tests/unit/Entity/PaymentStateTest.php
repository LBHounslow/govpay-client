<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\PaymentState;
use Tests\Unit\AbstractTestCase;

class PaymentStateTest extends AbstractTestCase
{
    /**
     * @var PaymentState
     */
    private $paymentState;

    public function setUp(): void
    {
        $this->paymentState = new PaymentState();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->paymentState->fromArray([]);
        $this->assertInstanceOf(PaymentState::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->paymentState->fromArray(
            [
                'status' => self::PAYMENT_STATE_STATUS,
                'finished' => self::PAYMENT_STATE_FINISHED,
                'message' => self::PAYMENT_STATE_MESSAGE,
                'code' => self::PAYMENT_STATE_CODE
            ]
        );
        $this->assertEquals(self::PAYMENT_STATE_STATUS, $result->getStatus());
        $this->assertEquals(self::PAYMENT_STATE_FINISHED, $result->isFinished());
        $this->assertEquals(self::PAYMENT_STATE_MESSAGE, $result->getMessage());
        $this->assertEquals(self::PAYMENT_STATE_CODE, $result->getCode());
    }
}