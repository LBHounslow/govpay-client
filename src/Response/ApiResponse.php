<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Response;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Exception\InvalidApiResponseException;

final class ApiResponse
{
    /**
     * @var GuzzleResponse
     */
    private $guzzleResponse;

    /**
     * @var array
     */
    private $body;

    /**
     * @var string
     */
    private $field = '';

    /**
     * @var string
     */
    private $code = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @param GuzzleResponse $response
     */
    public function __construct(GuzzleResponse $response)
    {
        $this->guzzleResponse = $response;
        $this->parseGuzzleResponse();
    }

    /**
     * @return GuzzleResponse
     */
    public function getGuzzleResponse(): GuzzleResponse
    {
        return $this->guzzleResponse;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return empty($this->errorCode) && empty($this->code);
    }

    /**
     * @return string
     */
    public function getErrorField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getErrorDescription(): string
    {
        return $this->description;
    }

    /**
     * @throws InvalidApiResponseException
     */
    public function parseGuzzleResponse()
    {
        $body = (string) $this->getGuzzleResponse()->getBody();

        if (empty($body)) {
            throw new InvalidApiResponseException('Request body is empty');
        }

        if (!$this->isJson($body)) {
            throw new InvalidApiResponseException('Request body is not in JSON format');
        }

        $this->body = json_decode($body, true);
        $this->body = isset($this->body['events']) ? $this->body['events'] : $this->body;
        $this->body = isset($this->body['_embedded']['refunds']) ? $this->body['_embedded']['refunds'] : $this->body;

        if (isset($this->body['code']) && isset($this->body['description'])) {
            $this->field = isset($this->body['field']) ? $this->body['field'] : $this->field;
            $this->code = $this->body['code'];
            $this->description = $this->body['description'];
        }
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
