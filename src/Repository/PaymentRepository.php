<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Repository;

use GuzzleHttp\Exception\GuzzleException;
use LBHounslow\GovPay\Client\Client;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\PaymentEvent;
use LBHounslow\GovPay\Entity\Refund;
use LBHounslow\GovPay\Exception\ApiException;
use LBHounslow\GovPay\Exception\InvalidEntityClassException;
use LBHounslow\GovPay\Exception\ValidationException;
use LBHounslow\GovPay\Factory\ArrayToEntityFactory;
use LBHounslow\GovPay\Response\ApiResponse;

class PaymentRepository extends BaseEntityRepository
{
    /**
     * @param Client $client
     * @param string $entityClass
     */
    public function __construct(Client $client, string $entityClass = Payment::class)
    {
        parent::__construct($client, $entityClass);
    }

    /**
     * @param string $cardBrand
     * @return PaymentRepository
     */
    public function setCardBrand(string $cardBrand): PaymentRepository
    {
        $this->queryStringBuilder->setCardBrand($cardBrand);
        return $this;
    }

    /**
     * @param string $reference
     * @return PaymentRepository
     */
    public function setReference(string $reference): PaymentRepository
    {
        $this->queryStringBuilder->$this->setReference($reference);
        return $this;
    }

    /**
     * @param string $email
     * @return PaymentRepository
     */
    public function setEmail(string $email): PaymentRepository
    {
        $this->queryStringBuilder->setEmail($email);
        return $this;
    }

    /**
     * @param string $cardholderName
     * @return PaymentRepository
     */
    public function setCardholderName(string $cardholderName): PaymentRepository
    {
        $this->queryStringBuilder->setCardholderName($cardholderName);
        return $this;
    }

    /**
     * @param string $state
     * @return PaymentRepository
     */
    public function setState(string $state): PaymentRepository
    {
        $this->queryStringBuilder->setState($state);
        return $this;
    }

    /**
     * @param string $firstDigitsCardNumber
     * @return PaymentRepository
     */
    public function setFirstDigitsCardNumber(string $firstDigitsCardNumber): PaymentRepository
    {
        $this->queryStringBuilder->setFirstDigitsCardNumber($firstDigitsCardNumber);
        return $this;
    }

    /**
     * @param string $lastDigitsCardNumber
     * @return PaymentRepository
     */
    public function setLastDigitsCardNumber(string $lastDigitsCardNumber): PaymentRepository
    {
        $this->queryStringBuilder->setLastDigitsCardNumber($lastDigitsCardNumber);
        return $this;
    }

    /**
     * @param string $id
     * @return Payment
     * @throws ApiException
     * @throws GuzzleException
     * @throws InvalidEntityClassException
     */
    public function find(string $id)
    {
        /** @var ApiResponse $response */
        $response = $this->client->get(sprintf(Client::PAYMENT, $id));

        /** @var Payment $payment */
        $payment = (new ArrayToEntityFactory($response->fetchOne(), Payment::class))->factory();

        return $payment;
    }

    /**
     * @param string $id
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     * @throws InvalidEntityClassException
     */
    public function fetchPaymentEvents(string $id)
    {
        $results = [];

        /** @var ApiResponse $response */
        $response = $this->client->get(sprintf(Client::PAYMENT_EVENTS, $id));

        /** @var array $row */
        foreach ($response->fetchAll() as $row) {
            /** @var PaymentEvent $paymentEvent */
            $paymentEvent = (new ArrayToEntityFactory($row, PaymentEvent::class))->factory();
            $results[] = $paymentEvent;
        }

        return $results;
    }

    /**
     * @param string $id
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     * @throws InvalidEntityClassException
     */
    public function fetchPaymentRefunds(string $id)
    {
        $results = [];

        /** @var ApiResponse $response */
        $response = $this->client->get(sprintf(Client::PAYMENT_REFUNDS, $id));

        /** @var array $row */
        foreach ($response->fetchAll() as $row) {
            /** @var PaymentEvent $paymentEvent */
            $paymentEvent = (new ArrayToEntityFactory($row, Refund::class))->factory();
            $paymentEvent->setPaymentId($id);
            $results[] = $paymentEvent;
        }

        return $results;
    }

    /**
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     * @throws InvalidEntityClassException
     * @throws ValidationException
     */
    public function fetchAll()
    {
        $results = [];

        /** @var ApiResponse $response */
        $response = $this->client->get(Client::SEARCH_PAYMENTS . $this->queryStringBuilder->build());

        /** @var array $row */
        foreach ($response->fetchAll() as $row) {
            /** @var Payment $payment */
            $payment = (new ArrayToEntityFactory($row, Payment::class))->factory();
            $results[] = $payment;
        }

        return $results;
    }
}