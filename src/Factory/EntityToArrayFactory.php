<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Factory;

use LBHounslow\GovPay\Entity\EntityToArrayInterface;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;

class EntityToArrayFactory implements FactoryInterface
{
    /**
     * @var EntityToArrayInterface
     */
    private $entity;

    /**
     * @param EntityToArrayInterface $entity
     */
    public function __construct(EntityToArrayInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return array
     * @throws InvalidEntityClassException
     */
    public function factory()
    {
        return $this->entity->toArray();
    }
}
