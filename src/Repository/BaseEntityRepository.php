<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Repository;

use LBHounslow\GovPay\Builder\QueryStringBuilder;
use LBHounslow\GovPay\Client\Client;

abstract class BaseEntityRepository implements EntityRepositoryInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var QueryStringBuilder
     */
    public $queryStringBuilder;

    /**
     * @param Client $client
     * @param string $entityClass
     */
    public function __construct(Client $client, string $entityClass = '')
    {
        $this->client = $client;
        $this->entityClass = $entityClass;
        $this->queryStringBuilder = new QueryStringBuilder();
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self
    {
        $this->queryStringBuilder->setPage($page);
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage): self
    {
        $this->queryStringBuilder->setPerPage($perPage);
        return $this;
    }

    /**
     * @param string $fromDate
     * @return $this
     */
    public function setFromDate(string $fromDate): self
    {
        $this->queryStringBuilder->setFromDate($fromDate);
        return $this;
    }

    /**
     * @param string $toDate
     * @return $this
     */
    public function setToDate(string $toDate): self
    {
        $this->queryStringBuilder->setToDate($toDate);
        return $this;
    }

    /**
     * @param string $fromSettledDate
     * @return $this
     */
    public function setFromSettledDate(string $fromSettledDate): self
    {
        $this->queryStringBuilder->setFromSettledDate($fromSettledDate);
        return $this;
    }

    /**
     * @param string $toSettledDate
     * @return $this
     */
    public function setToSettledDate(string $toSettledDate): self
    {
        $this->queryStringBuilder->setToSettledDate($toSettledDate);
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }
}