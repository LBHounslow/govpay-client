<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\PaymentEvent;
use LBHounslow\GovPay\Entity\PaymentState;
use Tests\Unit\AbstractTestCase;

class PaymentEventTest extends AbstractTestCase
{
    /**
     * @var PaymentEvent
     */
    private $paymentEvent;

    public function setUp(): void
    {
        $this->paymentEvent = new PaymentEvent();
        parent::setUp();
    }

    public function testSettersAndGetters()
    {
        $this->paymentEvent->setPaymentId('payment-id');
        $this->assertEquals('payment-id', $this->paymentEvent->getPaymentId());

        $this->paymentEvent->setUpdated('09-02-2022');
        $this->assertEquals('09-02-2022', $this->paymentEvent->getUpdated());

        $this->paymentEvent->setState(new PaymentState());
        $this->assertInstanceOf(PaymentState::class, $this->paymentEvent->getState());
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->paymentEvent->fromArray([]);
        $this->assertInstanceOf(PaymentEvent::class, $result);
    }

    public function testThatEntityLoadsEventDataCorrectly()
    {
        $result = $this->paymentEvent->fromArray(
            [
                'payment_id' => self::PAYMENT_PAYMENT_ID,
                'updated' => self::PAYMENT_UPDATED_DATE,
                'state' => [],
            ]
        );
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result->getPaymentId());
        $this->assertEquals(self::PAYMENT_UPDATED_DATE, $result->getUpdated());
    }

    public function testThatEntityLoadsEventWithStateDataCorrectly()
    {
        $result = $this->paymentEvent->fromArray(
            [
                'payment_id' => self::PAYMENT_PAYMENT_ID,
                'updated' => self::PAYMENT_UPDATED_DATE,
                'state' => [
                    'status' => self::PAYMENT_STATE_STATUS,
                    'finished' => self::PAYMENT_STATE_FINISHED,
                    'message' => self::PAYMENT_STATE_MESSAGE,
                    'code' => self::PAYMENT_STATE_CODE
                ],
            ]
        );
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result->getPaymentId());
        $this->assertEquals(self::PAYMENT_UPDATED_DATE, $result->getUpdated());
        $this->assertEquals(self::PAYMENT_STATE_STATUS, $result->getState()->getStatus());
        $this->assertEquals(self::PAYMENT_STATE_FINISHED, $result->getState()->isFinished());
        $this->assertEquals(self::PAYMENT_STATE_MESSAGE, $result->getState()->getMessage());
        $this->assertEquals(self::PAYMENT_STATE_CODE, $result->getState()->getCode());
    }
}