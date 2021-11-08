<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\PaymentEvent;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Repository\PaymentRepository;
use LBHounslow\GovPay\Response\ApiResponse;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Unit\AbstractTestCase;

class PaymentRepositoryTest extends AbstractTestCase
{
    /**
     * @var GovPayClient|MockObject
     */
    private $mockGovPayClient;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    public function setUp(): void
    {
        $this->mockGovPayClient = $this->getMockBuilder(GovPayClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['post', 'get'])
            ->getMock();
        $this->paymentRepository = new PaymentRepository($this->mockGovPayClient, Payment::class);
        parent::setUp();
    }

    public function testItReturnsEntityClass()
    {
        $this->assertEquals(Payment::class, $this->paymentRepository->getEntityClass());
    }

    public function testItFindsAndReturnsSinglePaymentEntity()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_ARRAY))
                )
            );
        /** @var Payment $payment */
        $payment = $this->paymentRepository->find(self::PAYMENT_PAYMENT_ID);
        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $payment->getPaymentId());
    }

    public function testItFetchesPaymentEventsForPayment()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_EVENTS_RESULTS_ARRAY))
                )
            );
        /** @var PaymentEvent[] $results */
        $results = $this->paymentRepository->fetchPaymentEvents(self::PAYMENT_PAYMENT_ID);
        $this->assertIsArray($results);
        $this->assertTrue(isset($results[0]));
        $this->assertInstanceOf(PaymentEvent::class, $results[0]);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $results[0]->getPaymentId());
    }

    public function testItFetchesPaymentRefundsForPayment()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_REFUNDS_RESULTS_ARRAY))
                )
            );
        /** @var Refund[] $results */
        $results = $this->paymentRepository->fetchPaymentRefunds(self::PAYMENT_PAYMENT_ID);
        $this->assertIsArray($results);
        $this->assertTrue(isset($results[0]));
        $this->assertInstanceOf(Refund::class, $results[0]);
        $this->assertEquals(self::REFUND_REFUND_ID, $results[0]->getRefundId());
    }

    public function testThatFetchAllWithNoQueryStringReturnsPaymentResults()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_SEARCH_RESULTS_ARRAY))
                )
            );
        /** @var Payment[] $results */
        $results = $this->paymentRepository->fetchAll();
        $this->assertIsArray($results);
        $this->assertTrue(isset($results[0]));
        $this->assertInstanceOf(Payment::class, $results[0]);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $results[0]->getPaymentId());
    }
}