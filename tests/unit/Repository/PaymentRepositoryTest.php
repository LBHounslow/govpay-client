<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\PaginatedResults;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\PaymentEvent;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiErrorResponseException;
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

    /**
     * @doesNotPerformAssertions
     */
    public function testSetters()
    {
        $this->paymentRepository->setCardBrand('visa');
        $this->paymentRepository->setReference('reference-123');
        $this->paymentRepository->setEmail('test@domain.com');
        $this->paymentRepository->setCardholderName('Test Person');
        $this->paymentRepository->setState('success');
        $this->paymentRepository->setFirstDigitsCardNumber('1234');
        $this->paymentRepository->setLastDigitsCardNumber('7890');
    }

    public function testThatFindThrowsApiErrorExceptionForErrorResponse()
    {
        $this->expectException(ApiErrorResponseException::class);
        $this->expectExceptionMessage(self::ERROR_DESCRIPTION);
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
                )
            );
        $this->paymentRepository->find(self::PAYMENT_PAYMENT_ID);
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
        $result = $this->paymentRepository->find(self::PAYMENT_PAYMENT_ID);
        $this->assertInstanceOf(Payment::class, $result);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result->getPaymentId());
    }

    public function testThatFetchPaymentEventsThrowsApiErrorExceptionForErrorResponse()
    {
        $this->expectException(ApiErrorResponseException::class);
        $this->expectExceptionMessage(self::ERROR_DESCRIPTION);
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
                )
            );
        $this->paymentRepository->fetchPaymentEvents(self::PAYMENT_PAYMENT_ID);
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
        $result = $this->paymentRepository->fetchPaymentEvents(self::PAYMENT_PAYMENT_ID);
        $this->assertTrue(isset($result[0]));
        $this->assertInstanceOf(PaymentEvent::class, $result[0]);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result[0]->getPaymentId());
    }

    public function testThatFetchPaymentRefundsThrowsApiErrorExceptionForErrorResponse()
    {
        $this->expectException(ApiErrorResponseException::class);
        $this->expectExceptionMessage(self::ERROR_DESCRIPTION);
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
                )
            );
        $this->paymentRepository->fetchPaymentRefunds(self::PAYMENT_PAYMENT_ID);
    }

    public function testItFetchesPaymentRefundsForPayment()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_REFUNDS_RESULTS_ARRAY_WITH_PAYMENT_LINK))
                )
            );
        $result = $this->paymentRepository->fetchPaymentRefunds(self::PAYMENT_PAYMENT_ID);
        $this->assertIsArray($result);
        $this->assertTrue(isset($result[0]));
        $this->assertInstanceOf(Refund::class, $result[0]);
        $this->assertEquals(self::REFUND_REFUND_ID, $result[0]->getRefundId());
    }

    public function testThatFetchAllThrowsApiErrorExceptionForErrorResponse()
    {
        $this->expectException(ApiErrorResponseException::class);
        $this->expectExceptionMessage(self::ERROR_DESCRIPTION);
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
                )
            );
        $this->paymentRepository->fetchAll();
    }

    public function testThatFetchAllWithWithNoResponseDataReturnsEmptyPaginatedResults()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::SEARCH_RESULTS_EMPTY_ARRAY))
                )
            );
        $result = $this->paymentRepository->fetchAll();
        $this->assertInstanceOf(PaginatedResults::class, $result);
        $this->assertEquals([], $result->getResults());
        $this->assertEquals(0, $result->getTotal());
    }

    public function testThatFetchAllWithPaymentResponseDataReturnsPaginatedResults()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_SEARCH_RESULTS_ARRAY))
                )
            );
        $result = $this->paymentRepository->fetchAll();
        $this->assertInstanceOf(PaginatedResults::class, $result);
        $this->assertTrue(isset($result->getResults()[0]));
        $this->assertInstanceOf(Payment::class, $result->getResults()[0]);
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result->getResults()[0]->getPaymentId());
    }
}