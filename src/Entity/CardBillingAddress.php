<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class CardBillingAddress implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $line1 = '';

    /**
     * @var string
     */
    private $line2 = '';

    /**
     * @var string
     */
    private $postCode = '';

    /**
     * @var string
     */
    private $city = '';

    /**
     * @var string
     */
    private $country = '';

    /**
     * @return string
     */
    public function getLine1(): string
    {
        return $this->line1;
    }

    /**
     * @param string $line1
     * @return CardBillingAddress
     */
    public function setLine1(string $line1): CardBillingAddress
    {
        $this->line1 = $line1;
        return $this;
    }

    /**
     * @return string
     */
    public function getLine2(): string
    {
        return $this->line2;
    }

    /**
     * @param string $line2
     * @return CardBillingAddress
     */
    public function setLine2(string $line2): CardBillingAddress
    {
        $this->line2 = $line2;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     * @return CardBillingAddress
     */
    public function setPostCode(string $postCode): CardBillingAddress
    {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return CardBillingAddress
     */
    public function setCity(string $city): CardBillingAddress
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return CardBillingAddress
     */
    public function setCountry(string $country): CardBillingAddress
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setLine1(isset($data['line1']) ? $data['line1'] : '')
            ->setLine2(isset($data['line2']) ? $data['line2'] : '')
            ->setPostCode(isset($data['postcode']) ? $data['postcode'] : '')
            ->setCity(isset($data['city']) ? $data['city'] : '')
            ->setCountry(isset($data['country']) ? $data['country'] : '');
        return $this;
    }
}