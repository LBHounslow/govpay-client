<?php

declare(strict_types=1);

namespace Tests\Unit\Response;

use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\InvalidApiResponseException;
use LBHounslow\GovPay\Response\ApiResponse;
use Tests\Unit\AbstractTestCase;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

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

    public function testItReturnsStructuredResponseForSingleRecordResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_ARRAY))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->fetchOne());
        $this->assertArrayHasKey('amount', $apiResponse->fetchOne());
        $this->assertEquals($apiResponse->fetchOne()['amount'], self::PAYMENT_AMOUNT);
    }

    public function testItReturnsStructuredResponseForEmptySearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode([]))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->fetchAll());
        $this->assertEmpty($apiResponse->fetchAll());
    }

    public function testItReturnsStructuredResponseForSearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_SEARCH_RESULTS_ARRAY))
        );
        $this->assertTrue($apiResponse->isSuccessful());
        $this->assertIsArray($apiResponse->fetchAll());
        $this->assertNotEmpty($apiResponse->fetchAll());
        $this->assertEquals(self::SEARCH_RESULTS_COUNT, $apiResponse->getCount());
        $this->assertEquals(self::SEARCH_RESULTS_PAGE, $apiResponse->getPage());
        $this->assertEquals(self::SEARCH_RESULTS_TOTAL, $apiResponse->getTotal());
        $this->assertEquals(self::SEARCH_LINKS_SELF_HREF, $apiResponse->getCurrentPageUri());
        $this->assertEquals(self::SEARCH_LINKS_FIRST_HREF, $apiResponse->getFirstPageUri());
        $this->assertEquals(self::SEARCH_LINKS_PREV_HREF, $apiResponse->getPrevPageUri());
        $this->assertEquals(self::SEARCH_LINKS_NEXT_HREF, $apiResponse->getNextPageUri());
        $this->assertEquals(self::SEARCH_LINKS_LAST_HREF, $apiResponse->getLastPageUri());
        $this->assertEquals(self::PAYMENT_ARRAY, $apiResponse->fetchAll()[0]);
    }
}