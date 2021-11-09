<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
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

    public function testThatFetchAllWithNoQueryStringReturnsPaymentResults()
    {
        $this->mockGovPayClient
            ->method('get')
            ->willReturn(
                new ApiResponse(
                    new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::REFUND_SEARCH_RESULTS_ARRAY))
                )
            );
        /** @var Refund[] $results */
        $results = $this->refundRepository->fetchAll();
        $this->assertIsArray($results);
        $this->assertTrue(isset($results[0]));
        $this->assertInstanceOf(Refund::class, $results[0]);
        $this->assertEquals(self::REFUND_REFUND_ID, $results[0]->getRefundId());
    }
}