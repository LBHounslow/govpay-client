<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Builder;

use LBHounslow\GovPay\Enum\DateFormatEnum;
use LBHounslow\GovPay\Exception\ValidationException;
use LBHounslow\GovPay\Validator\Repository\QueryStringValidator;

/**
 * Builds a validated and correctly encoded querystring for api searches
 */
final class QueryStringBuilder implements BuilderInterface
{
    const DEFAULT_PER_PAGE = 500;

    const PAGE = 'page';
    const DISPLAY_SIZE = 'display_size';
    const FROM_DATE = 'from_date';
    const TO_DATE = 'to_date';
    const FROM_SETTLED_DATE = 'from_settled_date';
    const TO_SETTLED_DATE = 'to_settled_date';
    const STATE = 'state';
    const EMAIL = 'email';
    const CARD_BRAND = 'card_brand';
    const REFERENCE = 'reference';
    const CARDHOLDER_NAME = 'cardholder_name';
    const FIRST_DIGITS_CARD_NUMBER = 'first_digits_card_number';
    const LAST_DIGITS_CARD_NUMBER = 'last_digits_card_number';

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $perPage = self::DEFAULT_PER_PAGE;

    /**
     * @var string
     */
    private $fromDate = '';

    /**
     * @var string
     */
    private $toDate = '';

    /**
     * @var string
     */
    private $fromSettledDate = '';

    /**
     * @var string
     */
    private $toSettledDate = '';

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var string
     */
    private $reference = '';

    /**
     * @var string
     */
    private $state = '';

    /**
     * @var string
     */
    private $cardBrand = '';

    /**
     * @var string
     */
    private $cardholderName = '';

    /**
     * @var string
     */
    private $firstDigitsCardNumber = '';

    /**
     * @var string
     */
    private $lastDigitsCardNumber = '';

    /**
     * @var QueryStringValidator
     */
    private $validator;

    public function __construct()
    {
        $this->validator = new QueryStringValidator();
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function build()
    {
        $params = [
            self::PAGE => $this->page,
            self::DISPLAY_SIZE => $this->perPage
        ];

        if ($this->fromDate && $this->validator->isValidDate($this->fromDate)) {
            $params[self::FROM_DATE] = $this->getUtcZuluDateFromLocalDate($this->fromDate);
        }

        if ($this->toDate && $this->validator->isValidDate($this->toDate)) {
            $params[self::TO_DATE] = $this->getUtcZuluDateFromLocalDate($this->toDate);
        }

        if ($this->fromSettledDate && $this->validator->isValidDate($this->fromSettledDate)) {
            $params[self::FROM_SETTLED_DATE] = $this->getUtcZuluDateFromLocalDate($this->fromSettledDate);
        }

        if ($this->toSettledDate && $this->validator->isValidDate($this->toSettledDate)) {
            $params[self::TO_SETTLED_DATE] = $this->getUtcZuluDateFromLocalDate($this->toSettledDate);
        }

        if ($this->state && $this->validator->isValidPaymentState($this->state)) {
            $params[self::STATE] = $this->state;
        }

        if ($this->email && $this->validator->isValidEmail($this->email)) {
            $params[self::EMAIL] = urlencode($this->email);
        }

        if ($this->cardBrand && $this->validator->isValidCardBrand($this->cardBrand)) {
            $params[self::CARD_BRAND] = $this->cardBrand;
        }

        if ($this->reference) $params[self::REFERENCE] = $this->reference;
        if ($this->cardholderName) $params[self::CARDHOLDER_NAME] = urlencode($this->cardholderName);
        if ($this->firstDigitsCardNumber) $params[self::FIRST_DIGITS_CARD_NUMBER] = urlencode($this->firstDigitsCardNumber);
        if ($this->lastDigitsCardNumber) $params[self::LAST_DIGITS_CARD_NUMBER] = urlencode($this->lastDigitsCardNumber);

        return $this->buildQueryString($params);
    }

    /**
     * @param array $params
     * @return string
     */
    public function buildQueryString(array $params)
    {
        $queryString = '';
        foreach ($params as $key => $value) {
            $queryString .= $key . '=' . $value . '&';
        }
        return '?' . substr($queryString, 0, -1);
    }

    /**
     * @param string $localDateTime
     * @return string
     */
    public function getUtcZuluDateFromLocalDate(string $localDateTime)
    {
        $localDate = \DateTime::createFromFormat(DateFormatEnum::MYSQL, $localDateTime);
        $utcDate = $localDate->setTimezone(new \DateTimeZone('UTC'));
        return $utcDate->format(DateFormatEnum::UTC_ZULU);
    }

    /**
     * @param int $page
     * @return QueryStringBuilder
     */
    public function setPage(int $page): QueryStringBuilder
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $perPage
     * @return QueryStringBuilder
     */
    public function setPerPage(int $perPage): QueryStringBuilder
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @param string $fromDate
     * @return QueryStringBuilder
     */
    public function setFromDate(string $fromDate): QueryStringBuilder
    {
        $this->fromDate = $fromDate;
        return $this;
    }

    /**
     * @param string $toDate
     * @return QueryStringBuilder
     */
    public function setToDate(string $toDate): QueryStringBuilder
    {
        $this->toDate = $toDate;
        return $this;
    }

    /**
     * @param string $fromSettledDate
     * @return QueryStringBuilder
     */
    public function setFromSettledDate(string $fromSettledDate): QueryStringBuilder
    {
        $this->fromSettledDate = $fromSettledDate;
        return $this;
    }

    /**
     * @param string $toSettledDate
     * @return QueryStringBuilder
     */
    public function setToSettledDate(string $toSettledDate): QueryStringBuilder
    {
        $this->toSettledDate = $toSettledDate;
        return $this;
    }

    /**
     * @param string $email
     * @return QueryStringBuilder
     */
    public function setEmail(string $email): QueryStringBuilder
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $reference
     * @return QueryStringBuilder
     */
    public function setReference(string $reference): QueryStringBuilder
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param string $state
     * @return QueryStringBuilder
     */
    public function setState(string $state): QueryStringBuilder
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param string $cardBrand
     * @return QueryStringBuilder
     */
    public function setCardBrand(string $cardBrand): QueryStringBuilder
    {
        $this->cardBrand = $cardBrand;
        return $this;
    }

    /**
     * @param string $cardholderName
     * @return QueryStringBuilder
     */
    public function setCardholderName(string $cardholderName): QueryStringBuilder
    {
        $this->cardholderName = $cardholderName;
        return $this;
    }

    /**
     * @param string $firstDigitsCardNumber
     * @return QueryStringBuilder
     */
    public function setFirstDigitsCardNumber(string $firstDigitsCardNumber): QueryStringBuilder
    {
        $this->firstDigitsCardNumber = $firstDigitsCardNumber;
        return $this;
    }

    /**
     * @param string $lastDigitsCardNumber
     * @return QueryStringBuilder
     */
    public function setLastDigitsCardNumber(string $lastDigitsCardNumber): QueryStringBuilder
    {
        $this->lastDigitsCardNumber = $lastDigitsCardNumber;
        return $this;
    }
}