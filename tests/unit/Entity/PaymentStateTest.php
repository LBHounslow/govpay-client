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

    public function testSettersAndGetters()
    {
        $this->paymentState->setStatus('success');
        $this->assertEquals('success', $this->paymentState->getStatus());

        $this->paymentState->setFinished(true);
        $this->assertTrue($this->paymentState->isFinished());

        $this->paymentState->setMessage('here is a message');
        $this->assertEquals('here is a message', $this->paymentState->getMessage());

        $this->paymentState->setCode('400');
        $this->assertEquals('400', $this->paymentState->getCode());
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