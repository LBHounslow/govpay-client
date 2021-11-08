<?php

namespace LBHounslow\GovPay\Repository;

use LBHounslow\GovPay\Client\Client;

interface EntityRepositoryInterface
{
    /**
     * @param Client $client
     * @param string $entityClass
     */
    public function __construct(Client $client, string $entityClass = '');

    /**
     * @return string
     */
    public function getEntityClass();
}