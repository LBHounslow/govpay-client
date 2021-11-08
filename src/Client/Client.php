<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\RequestOptions;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Exception\ApiException;
use LBHounslow\GovPay\Exception\RepositoryNotFoundException;
use LBHounslow\GovPay\Response\ApiResponse;

class Client
{
    const API_BASE_URL = 'https://publicapi.payments.service.gov.uk';
    const CONNECT_TIMEOUT = 5;

    const PAYMENTS_ENDPOINT = '/v1/payments';
    const PAYMENTS_EVENTS_ENDPOINT = '/v1/payments/%s/events';
    const PAYMENTS_REFUNDS_ENDPOINT = '/v1/payments/%s/refunds';
    const REFUNDS_ENDPOINT = '/v1/refunds';

    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param GuzzleClient $guzzleClient
     * @param string $apiKey
     */
    public function __construct(
        GuzzleClient $guzzleClient,
        string $apiKey = ''
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->setApiKey($apiKey);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Client
     */
    public function setApiKey(string $apiKey): Client
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return ApiResponse
     * @throws ApiException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function post(string $endpoint, array $data = [])
    {
        try {
            /** @var GuzzleResponse $guzzleResponse */
            $guzzleResponse = $this->guzzleClient->post(
                self::API_BASE_URL . $endpoint,
                [
                    RequestOptions::JSON => $data,
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer ' . $this->getApiKey(),
                        'Accept' => 'application/json',
                    ],
                    RequestOptions::CONNECT_TIMEOUT => self::CONNECT_TIMEOUT
                ]
            );
        } catch (\Exception $e) {
            throw new ApiException(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        if (empty($guzzleResponse) || !$guzzleResponse instanceof GuzzleResponse) {
            throw new ApiException(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, 'Unrecognised response from API');
        }

        return new ApiResponse($guzzleResponse);
    }

    /**
     * @param string $endpoint
     * @return ApiResponse
     * @throws ApiException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function get(string $endpoint)
    {
        try {
            /** @var GuzzleResponse $guzzleResponse */
            $guzzleResponse = $this->guzzleClient->get(
                self::API_BASE_URL . $endpoint,
                [
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer ' . $this->getApiKey(),
                        'Accept' => 'application/json',
                    ],
                    RequestOptions::CONNECT_TIMEOUT => self::CONNECT_TIMEOUT
                ]
            );
        } catch (\Exception $e) {
            throw new ApiException(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        if (empty($guzzleResponse) || !$guzzleResponse instanceof GuzzleResponse) {
            throw new ApiException(HttpStatusCodeEnum::INTERNAL_SERVER_ERROR, 'Unrecognised response from API');
        }

        return new ApiResponse($guzzleResponse);
    }

    /**
     * @param string $entityClass
     * @return object
     * @throws RepositoryNotFoundException
     */
    public function getRepository(string $entityClass)
    {
        try {
            $repositoryInstance = (new \ReflectionClass(
                sprintf(
                    'LBHounslow\\GovPay\\Repository\\%sRepository',
                    (new \ReflectionClass($entityClass))->getShortName()
                )
            ))->newInstanceArgs([$this, $entityClass]);
        } catch (\ReflectionException $e) {
            throw new RepositoryNotFoundException($entityClass);
        }
        return $repositoryInstance;
    }
}
