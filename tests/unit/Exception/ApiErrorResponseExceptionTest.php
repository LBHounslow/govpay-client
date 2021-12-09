<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiErrorResponseException;
use LBHounslow\GovPay\Response\ApiResponse;
use Tests\Unit\AbstractTestCase;

class ApiErrorResponseExceptionTest extends AbstractTestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::BAD_REQUEST, [], json_encode(self::ERROR_RESPONSE_WITH_FIELD))
        );

        $result = new ApiErrorResponseException($apiResponse);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertInstanceOf(ApiResponse::class, $result->getApiResponse());
        $this->assertInstanceOf(GuzzleResponse::class, $result->getApiResponse()->getGuzzleResponse());
        $this->assertEquals(HttpStatusCodeEnum::BAD_REQUEST, $result->getApiResponse()->getGuzzleResponse()->getStatusCode());
        $this->assertFalse($result->getApiResponse()->isSuccessful());
        $this->assertEquals(self::ERROR_RESPONSE_WITH_FIELD, $result->getApiResponse()->getBody());
        $this->assertEquals(self::ERROR_FIELD, $result->getApiResponse()->getErrorField());
        $this->assertEquals(self::ERROR_CODE, $result->getApiResponse()->getErrorCode());
        $this->assertEquals(self::ERROR_DESCRIPTION, $result->getApiResponse()->getErrorDescription());
    }
}
