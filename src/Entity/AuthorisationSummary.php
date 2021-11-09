<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class AuthorisationSummary implements ArrayToEntityInterface
{
    /**
     * @var bool
     */
    private $threeDSecureRequired = false;

    /**
     * @return bool
     */
    public function isThreeDSecureRequired(): bool
    {
        return $this->threeDSecureRequired;
    }

    /**
     * @param bool $threeDSecureRequired
     * @return AuthorisationSummary
     */
    public function setThreeDSecureRequired(bool $threeDSecureRequired): AuthorisationSummary
    {
        $this->threeDSecureRequired = $threeDSecureRequired;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setThreeDSecureRequired(isset($data['three_d_secure']['required']) ? $data['three_d_secure']['required'] :false);
        return $this;
    }
}