<?php

declare(strict_types=1);

namespace Tests\Unit\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\InvalidArgumentException as GuzzleInvalidArgumentException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Client\Client;
use LBHounslow\GovPay\Client\Client as GovPayClient;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiException;
use LBHounslow\GovPay\Exception\RepositoryNotFoundException;
use LBHounslow\GovPay\Repository\EntityRepositoryInterface;
use LBHounslow\GovPay\Response\ApiResponse;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Unit\AbstractTestCase;

class ClientTest extends AbstractTestCase
{
    /**
     * @var GovPayClient
     */
    private $govPayClient;

    /**
     * @var GuzzleClient|MockObject
     */
    private $mockGuzzleClient;

    public function setUp(): void
    {
        $this->mockGuzzleClient = $this->getMockBuilder(GuzzleClient::class)
            ->onlyMethods(['post', 'get'])
            ->getMock();
        $this->govPayClient = new GovPayClient($this->mockGuzzleClient, 'api-key');
        parent::setUp();
    }

    public function testThatConstructorSetsApiKey()
    {
        $this->assertEquals('api-key', $this->govPayClient->getApiKey());
    }

    public function testThatGetRepositoryThrowsExceptionForInvalidEntityClassName()
    {
        $this->expectException(RepositoryNotFoundException::class);
        $this->govPayClient->getRepository('InvalidClassName');
    }

    public function testThatGetRepositoryReturnsRepositoryInstanceForValidEntityClassName()
    {
        $result = $this->govPayClient->getRepository(Payment::class);
        $this->assertInstanceOf(EntityRepositoryInterface::class, $result);
    }

    public function testPostMethodHandlesGuzzleExceptions()
    {
        $this->mockGuzzleClient
            ->method('post')
            ->willThrowException(new GuzzleInvalidArgumentException('Guzzle error'));
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Guzzle error');
        $this->govPayClient->post(Client::PAYMENT);
    }

    /**
     * @param GuzzleResponse $response
     * @param bool $isSuccessful
     * @param array $expectedPayload
     * @dataProvider successfulPostResponseDataProvider
     */
    public function testSuccessfulPostMethodReturnsValidResponse(GuzzleResponse $response, bool $isSuccessful, array $expectedPayload)
    {
        $this->mockGuzzleClient
            ->method('post')
            ->willReturn($response);

        /** @var ApiResponse $apiResponse */
        $apiResponse = $this->govPayClient->post(Client::PAYMENT);

        $this->assertInstanceOf(ApiResponse::class, $apiResponse);
        $this->assertEquals($isSuccessful, $apiResponse->isSuccessful());
        $this->assertEquals($expectedPayload, $apiResponse->fetchOne());
    }

    public function successfulPostResponseDataProvider()
    {
        return [
            [new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_ARRAY)), true, self::PAYMENT_ARRAY],
            [new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD)), false, []],
            [new GuzzleResponse(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD)), false, []]
        ];
    }

    public function testGetMethodHandlesGuzzleExceptions()
    {
        $this->mockGuzzleClient
            ->method('get')
            ->willThrowException(new GuzzleInvalidArgumentException('Guzzle error'));
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Guzzle error');
        $this->govPayClient->get(Client::PAYMENT);
    }

    /**
     * @param GuzzleResponse $response
     * @param bool $isSuccessful
     * @param array $expectedPayload
     * @dataProvider successfulPostResponseDataProvider
     */
    public function testSuccessfulGetMethodReturnsValidResponse(GuzzleResponse $response, bool $isSuccessful, array $expectedPayload)
    {
        $this->mockGuzzleClient
            ->method('get')
            ->willReturn($response);

        /** @var ApiResponse $apiResponse */
        $apiResponse = $this->govPayClient->get(Client::PAYMENT);

        $this->assertInstanceOf(ApiResponse::class, $apiResponse);
        $this->assertEquals($isSuccessful, $apiResponse->isSuccessful());
        $this->assertEquals($expectedPayload, $apiResponse->fetchOne());
    }

    public function successfulGetResponseDataProvider()
    {
        return [
            [new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_ARRAY)), true, self::PAYMENT_ARRAY],
            [new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD)), false, []],
            [new GuzzleResponse(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD)), false, []]
        ];
    }
}