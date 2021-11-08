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
     * @var int
     */
    private $total = 0;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var array
     */
    private $results = [];

    /**
     * @var string
     */
    private $firstPageUri = '';

    /**
     * @var string
     */
    private $currentPageUri = '';

    /**
     * @var string
     */
    private $prevPageUri = '';

    /**
     * @var string
     */
    private $nextPageUri = '';

    /**
     * @var string
     */
    private $lastPageUri = '';

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
     * Returns single result
     *
     * @return array
     */
    public function fetchOne(): array
    {
        return $this->isSuccessful() ? $this->body : [];
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return empty($this->errorCode) && empty($this->code);
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return array
     */
    public function fetchAll(): array
    {
        return $this->results;
    }

    /**
     * @return string
     */
    public function getFirstPageUri(): string
    {
        return $this->firstPageUri;
    }

    /**
     * @return string
     */
    public function getCurrentPageUri(): string
    {
        return $this->currentPageUri;
    }

    /**
     * @return string
     */
    public function getNextPageUri(): string
    {
        return $this->nextPageUri;
    }

    /**
     * @return string
     */
    public function getPrevPageUri(): string
    {
        return $this->prevPageUri;
    }

    /**
     * @return string
     */
    public function getLastPageUri(): string
    {
        return $this->lastPageUri;
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

        if (isset($this->body['code']) && isset($this->body['description'])) {
            $this->field = isset($this->body['field']) ? $this->body['field'] : $this->field;
            $this->code = $this->body['code'];
            $this->description = $this->body['description'];
        }

        $this->total = isset($this->body['total']) ? $this->body['total'] : $this->total;
        $this->count = isset($this->body['count']) ? $this->body['count'] : $this->count;
        $this->page = isset($this->body['page']) ? $this->body['page'] : $this->page;
        $this->results = isset($this->body['results']) ? $this->body['results'] : $this->results;
        $this->results = isset($this->body['events']) ? $this->body['events'] : $this->results;
        $this->results = isset($this->body['_embedded']['refunds']) ? $this->body['_embedded']['refunds'] : $this->results;
        $this->firstPageUri = isset($this->body['_links']['first_page']['href']) ? $this->body['_links']['first_page']['href'] : $this->firstPageUri;
        $this->currentPageUri = isset($this->body['_links']['self']['href']) ? $this->body['_links']['self']['href'] : $this->currentPageUri;
        $this->prevPageUri = isset($this->body['_links']['prev_page']['href']) ? $this->body['_links']['prev_page']['href'] : $this->prevPageUri;
        $this->nextPageUri = isset($this->body['_links']['next_page']['href']) ? $this->body['_links']['next_page']['href'] : $this->nextPageUri;
        $this->lastPageUri = isset($this->body['_links']['last_page']['href']) ? $this->body['_links']['last_page']['href'] : $this->lastPageUri;
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
