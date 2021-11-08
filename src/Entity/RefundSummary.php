<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class RefundSummary implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $status = '';

    /**
     * @var int
     */
    private $amountAvailable = 0;

    /**
     * @var int
     */
    private $amountSubmitted = 0;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return RefundSummary
     */
    public function setStatus(string $status): RefundSummary
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountAvailable(): int
    {
        return $this->amountAvailable;
    }

    /**
     * @param int $amountAvailable
     * @return RefundSummary
     */
    public function setAmountAvailable(int $amountAvailable): RefundSummary
    {
        $this->amountAvailable = $amountAvailable;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountSubmitted(): int
    {
        return $this->amountSubmitted;
    }

    /**
     * @param int $amountSubmitted
     * @return RefundSummary
     */
    public function setAmountSubmitted(int $amountSubmitted): RefundSummary
    {
        $this->amountSubmitted = $amountSubmitted;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setStatus(isset($data['status']) ? $data['status'] : '')
            ->setAmountAvailable(isset($data['amount_available']) ? $data['amount_available'] : 0)
            ->setAmountSubmitted(isset($data['amount_submitted']) ? $data['amount_submitted'] : 0);
        return $this;
    }
}
