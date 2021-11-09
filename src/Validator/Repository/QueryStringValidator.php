<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Validator\Repository;

use LBHounslow\GovPay\Entity\CardDetails;
use LBHounslow\GovPay\Entity\PaymentState;
use LBHounslow\GovPay\Enum\DateFormatEnum;
use LBHounslow\GovPay\Exception\ValidationException;

class QueryStringValidator
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isEmpty($value)
    {
        return empty($value);
    }

    /**
     * @param string $datetime
     */
    public function isValidDate(string $datetime)
    {
        if ($this->isEmpty($datetime) || !\DateTime::createFromFormat(DateFormatEnum::MYSQL, $datetime)) {
            throw new ValidationException(sprintf("'%s' is not a valid MySQL date", $datetime));
        }
        return true;
    }

    /**
     * @param string $state
     */
    public function isValidPaymentState(string $state)
    {
        if ($this->isEmpty($state) || !in_array($state, PaymentState::VALID_STATES)) {
            throw new ValidationException(sprintf("'%s' is not a valid payment state", $state));
        }
        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function isValidEmail(string $email)
    {
        if ($this->isEmpty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException(sprintf("'%s' is not a valid email address", $email));
        }
        return true;
    }

    /**
     * @param string $cardBrand
     * @return bool
     * @throws ValidationException
     */
    public function isValidCardBrand(string $cardBrand)
    {
        if ($this->isEmpty($cardBrand) || !in_array($cardBrand, CardDetails::VALID_CARD_BRANDS)) {
            throw new ValidationException(sprintf("'%s' is not a valid card brand", $cardBrand));
        }
        return true;
    }
}