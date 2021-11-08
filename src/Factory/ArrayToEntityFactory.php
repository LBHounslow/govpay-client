<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Factory;

use LBHounslow\GovPay\Entity\ArrayToEntityInterface;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;
use LBHounslow\GovPay\Exception\EntityClassNotFoundException;

class ArrayToEntityFactory implements FactoryInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $entityClassName;

    /**
     * @param array $data
     * @param string $entityClassName
     */
    public function __construct(array $data, string $entityClassName)
    {
        $this->data = $data;
        $this->entityClassName = $entityClassName;
    }

    /**
     * @return ArrayToEntityInterface
     * @throws InvalidEntityClassException
     */
    public function factory()
    {
        $entityClass = $this->getClassInstanceFromString();

        try {
            $entityClass->fromArray($this->data);
        } catch (\Exception $e) {
            throw new InvalidEntityClassException('There was a problem converting the entity: %s', $e->getMessage());
        }

        return $entityClass;
    }

    /**
     * @return ArrayToEntityInterface
     * @throws EntityClassNotFoundException
     * @throws InvalidEntityClassException
     */
    public function getClassInstanceFromString()
    {
        try {
            $reflectionClass = new \ReflectionClass($this->entityClassName);
            $instance = $reflectionClass->newInstance();
        } catch (\ReflectionException $e) {
            throw new EntityClassNotFoundException($this->entityClassName);
        }

        if (!$instance instanceof ArrayToEntityInterface) {
            throw new InvalidEntityClassException($this->entityClassName, ArrayToEntityInterface::class);
        }

        return $instance;
    }
}
