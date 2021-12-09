<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\PaginatedResults;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiErrorResponseException;
use LBHounslow\GovPay\Repository\RefundRepository;
use LBHounslow\GovPay\Response\ApiResponse;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Unit\AbstractTestCase;

class RefundRepositoryTest extends AbstractTestCase
{
    /**
     * @var GovPayClient|MockObject
     */
    private $mockGovPayClient;

    /**
     * @var RefundRepository
     */
    private $refundRepository;

    public function setUp(): void
    {
        $this->mockGovPayClient = $this->getMockBuilder(GovPayClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['post', 'get'])
            ->getMock();
        $this->refundRepository = new RefundRepository($this->mockGovPayClient, Refund::class);
        parent::setUp();
    }

    public function testItReturnsEntityClass()
    {
        $this->assertEquals(Refund::class, $this->refundRepository->getEntityClass());
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
        $this->refundRepository->fetchAll();
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
        $result = $this->refundRepository->fetchAll();
        $this->assertInstanceOf(PaginatedResults::class, $result);
        $this->assertEquals([], $result->getResults());
        $this->assertEquals(0, $result->getTotal());
    }

    public function testThatFetchAllWithNoQueryStringReturnsPaymentResults()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::REFUND_SEARCH_RESULTS_ARRAY))
                )
            );
        $result = $this->refundRepository->fetchAll();
        $this->assertInstanceOf(PaginatedResults::class, $result);
        $this->assertTrue(isset($result->getResults()[0]));
        $this->assertInstanceOf(Refund::class, $result->getResults()[0]);
        $this->assertEquals(self::REFUND_REFUND_ID, $result->getResults()[0]->getRefundId());
    }
}