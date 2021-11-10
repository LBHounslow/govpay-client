<?php

declare(strict_types=1);

namespace Tests\Unit\Response;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\InvalidApiResponseException;
use LBHounslow\GovPay\Response\ApiResponse;
use Tests\Unit\AbstractTestCase;

class ApiResponseTest extends AbstractTestCase
{
    public function testItThrowsExceptionForNullResponse()
    {
        $this->expectException(InvalidApiResponseException::class);
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], null)
        );
    }

    public function testItThrowsExceptionForNonJsonResponse()
    {
        $this->expectException(InvalidApiResponseException::class);
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], 'Non JSON response')
        );
    }

    public function testItReturnsStructuredErrorResponseWithoutField()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITHOUT_FIELD))
        );
        $this->assertFalse($apiResponse->isSuccessful());
        $this->assertEquals(self::ERROR_CODE, $apiResponse->getErrorCode());
        $this->assertEquals(self::ERROR_DESCRIPTION, $apiResponse->getErrorDescription());
    }

    public function testItReturnsStructuredErrorResponseWithField()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
        );
        $this->assertFalse($apiResponse->isSuccessful());
        $this->assertEquals(self::ERROR_FIELD, $apiResponse->getErrorField());
        $this->assertEquals(self::ERROR_CODE, $apiResponse->getErrorCode());
        $this->assertEquals(self::ERROR_DESCRIPTION, $apiResponse->getErrorDescription());
    }

    public function testThatGetBodyIsPopulatedForSingleRecordResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_ARRAY))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->getBody());
        $this->assertArrayHasKey('amount', $apiResponse->getBody());
        $this->assertEquals($apiResponse->getBody()['amount'], self::PAYMENT_AMOUNT);
    }

    public function testItReturnsStructuredResponseForEmptySearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode([]))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->getBody());
        $this->assertEquals([], $apiResponse->getBody());
    }

    public function testItReturnsStructuredResponseForSearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_SEARCH_RESULTS_ARRAY))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->getBody());
        $this->assertNotEmpty($apiResponse->getBody());
        $this->assertEquals(self::PAYMENT_SEARCH_RESULTS_ARRAY, $apiResponse->getBody());
    }
}