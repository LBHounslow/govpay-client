<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class CardDetails implements ArrayToEntityInterface
{
    const AMERICAN_EXPRESS = 'american-express'; // American Express
    const DINERS_CLUB = 'diners-club'; // Diners Club
    const DISCOVER = 'discover'; // Discover
    const JCB = 'jcb'; // Jcb
    const MAESTRO = 'maestro'; // Maestro
    const MASTERCARD = 'master-card'; // Mastercard
    const UNION_PAY = 'unionpay'; // Union Pay
    const VISA = 'visa'; // Visa

    const VALID_CARD_BRANDS = [
        self::AMERICAN_EXPRESS,
        self::DINERS_CLUB,
        self::DISCOVER,
        self::JCB,
        self::MAESTRO,
        self::MASTERCARD,
        self::UNION_PAY,
        self::VISA
    ];

    /**
     * @var string
     */
    private $cardBrand = '';

    /**
     * @var string
     */
    private $cardType = '';

    /**
     * @var string
     */
    private $firstDigitsCardNumber = '';

    /**
     * @var string
     */
    private $lastDigitsCardNumber = '';

    /**
     * @var string
     */
    private $expiryDate = '';

    /**
     * @var string
     */
    private $cardHolderName = '';

    /**
     * @var CardBillingAddress
     */
    private $cardBillingAddress;

    /**
     * @return string
     */
    public function getCardBrand(): string
    {
        return $this->cardBrand;
    }

    /**
     * @param string $cardBrand
     * @return CardDetails
     */
    public function setCardBrand(string $cardBrand): CardDetails
    {
        $this->cardBrand = $cardBrand;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardType(): string
    {
        return $this->cardType;
    }

    /**
     * @param string $cardType
     * @return CardDetails
     */
    public function setCardType(string $cardType): CardDetails
    {
        $this->cardType = $cardType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstDigitsCardNumber(): string
    {
        return $this->firstDigitsCardNumber;
    }

    /**
     * @param string $firstDigitsCardNumber
     * @return CardDetails
     */
    public function setFirstDigitsCardNumber(string $firstDigitsCardNumber): CardDetails
    {
        $this->firstDigitsCardNumber = $firstDigitsCardNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastDigitsCardNumber(): string
    {
        return $this->lastDigitsCardNumber;
    }

    /**
     * @param string $lastDigitsCardNumber
     * @return CardDetails
     */
    public function setLastDigitsCardNumber(string $lastDigitsCardNumber): CardDetails
    {
        $this->lastDigitsCardNumber = $lastDigitsCardNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiryDate(): string
    {
        return $this->expiryDate;
    }

    /**
     * @param string $expiryDate
     * @return CardDetails
     */
    public function setExpiryDate(string $expiryDate): CardDetails
    {
        $this->expiryDate = $expiryDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolderName(): string
    {
        return $this->cardHolderName;
    }

    /**
     * @param string $cardHolderName
     * @return CardDetails
     */
    public function setCardHolderName(string $cardHolderName): CardDetails
    {
        $this->cardHolderName = $cardHolderName;
        return $this;
    }

    /**
     * @return CardBillingAddress
     */
    public function getCardBillingAddress(): CardBillingAddress
    {
        return $this->cardBillingAddress;
    }

    /**
     * @param CardBillingAddress $cardBillingAddress
     * @return CardDetails
     */
    public function setCardBillingAddress(CardBillingAddress $cardBillingAddress): CardDetails
    {
        $this->cardBillingAddress = $cardBillingAddress;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setCardBrand(isset($data['card_brand']) ? $data['card_brand'] : '')
            ->setCardType(isset($data['card_type']) ? $data['card_type'] : '')
            ->setLastDigitsCardNumber(isset($data['last_digits_card_number']) ? $data['last_digits_card_number'] : '')
            ->setFirstDigitsCardNumber(isset($data['first_digits_card_number']) ? $data['first_digits_card_number'] : '')
            ->setExpiryDate(isset($data['expiry_date']) ? $data['expiry_date'] : '')
            ->setCardHolderName(isset($data['cardholder_name']) ? $data['cardholder_name'] : '')
            ->setCardBillingAddress(
                (new CardBillingAddress())->fromArray(isset($data['billing_address']) ? $data['billing_address'] : [])
            );
        return $this;
    }
}