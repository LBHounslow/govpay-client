<?php

namespace LBHounslow\GovPay\Exception;

use LBHounslow\GovPay\Response\ApiResponse;
use Throwable;

class ApiErrorResponseException extends \Exception
{
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    /**
     * @param ApiResponse $apiResponse
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        ApiResponse $apiResponse,
        $code = 0,
        Throwable $previous = null
    ) {
        $this->apiResponse = $apiResponse;
        parent::__construct($apiResponse->getErrorDescription(), $code, $previous);
    }

    /**
     * @return ApiResponse
     */
    public function getApiResponse(): ApiResponse
    {
        return $this->apiResponse;
    }

    /**
     * @param ApiResponse $apiResponse
     * @return ApiErrorResponseException
     */
    public function setApiResponse(ApiResponse $apiResponse): ApiErrorResponseException
    {
        $this->apiResponse = $apiResponse;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription(): string
    {
        return $this->apiResponse->getErrorDescription();
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->apiResponse->getErrorCode();
    }

    /**
     * @return string
     */
    public function getErrorField(): string
    {
        return $this->apiResponse->getErrorField();
    }
}