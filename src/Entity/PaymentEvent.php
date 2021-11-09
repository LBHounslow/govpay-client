<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class PaymentEvent implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $paymentId = '';

    /**
     * @var string
     */
    private $updated = '';

    /**
     * @var PaymentState
     */
    private $state;

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     * @return PaymentEvent
     */
    public function setPaymentId(string $paymentId): PaymentEvent
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @param string $updated
     * @return PaymentEvent
     */
    public function setUpdated(string $updated): PaymentEvent
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return PaymentState
     */
    public function getState(): PaymentState
    {
        return $this->state;
    }

    /**
     * @param PaymentState $state
     * @return PaymentEvent
     */
    public function setState(PaymentState $state): PaymentEvent
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setPaymentId(isset($data['payment_id']) ? $data['payment_id'] : '')
            ->setUpdated(isset($data['updated']) ? $data['updated'] : '')
            ->setState(
                (new PaymentState())->fromArray(isset($data['state']) ? $data['state'] : [])
            );
        return $this;
    }
}
