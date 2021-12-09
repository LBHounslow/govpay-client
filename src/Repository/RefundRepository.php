<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Repository;

use LBHounslow\GovPay\Client\Client;
use LBHounslow\GovPay\Entity\PaginatedResults;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Exception\ApiErrorResponseException;
use LBHounslow\GovPay\Exception\ApiException;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;
use LBHounslow\GovPay\Exception\ValidationException;
use LBHounslow\GovPay\Factory\ArrayToEntityFactory;
use LBHounslow\GovPay\Response\ApiResponse;

class RefundRepository extends BaseEntityRepository
{
    /**
     * @param Client $client
     * @param string $entityClass
     */
    public function __construct(Client $client, string $entityClass = Refund::class)
    {
        parent::__construct($client, $entityClass);
    }

    /**
     * @return PaginatedResults
     * @throws ApiErrorResponseException
     * @throws ApiException
     * @throws InvalidEntityClassException
     * @throws ValidationException
     */
    public function fetchAll()
    {
        /** @var ApiResponse $response */
        $response = $this->client->get(Client::SEARCH_REFUNDS . $this->queryStringBuilder->build());

        if (!$response->isSuccessful()) {
            throw new ApiErrorResponseException($response);
        }

        $paginatedResults = (new PaginatedResults())
            ->fromArray($response->getBody());

        $results = [];

        /** @var array $row */
        foreach ($paginatedResults->getResults() as $row) {
            /** @var Refund $refund */
            $refund = (new ArrayToEntityFactory($row, Refund::class))->factory();
            $results[] = $refund;
        }

        return $paginatedResults
            ->setResults($results);
    }
}