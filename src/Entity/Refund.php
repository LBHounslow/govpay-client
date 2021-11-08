<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class Refund implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $paymentId;

    /**
     * @var string
     */
    private $refundId = '';

    /**
     * @var string
     */
    private $createdDate = '';

    /**
     * @var int
     */
    private $amount = 0;

    /**
     * @var string
     */
    private $status = '';

    /**
     * @var SettlementSummary
     */
    private $settlementSummary;

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     * @return Refund
     */
    public function setPaymentId(string $paymentId): Refund
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefundId(): string
    {
        return $this->refundId;
    }

    /**
     * @param string $refundId
     * @return Refund
     */
    public function setRefundId(string $refundId): Refund
    {
        $this->refundId = $refundId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     * @return Refund
     */
    public function setCreatedDate(string $createdDate): Refund
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Refund
     */
    public function setAmount(int $amount): Refund
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Refund
     */
    public function setStatus(string $status): Refund
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return SettlementSummary
     */
    public function getSettlementSummary(): SettlementSummary
    {
        return $this->settlementSummary;
    }

    /**
     * @param SettlementSummary $settlementSummary
     * @return Refund
     */
    public function setSettlementSummary(SettlementSummary $settlementSummary): Refund
    {
        $this->settlementSummary = $settlementSummary;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setRefundId(isset($data['refund_id']) ? $data['refund_id'] : '')
            ->setCreatedDate(isset($data['created_date']) ? $data['created_date'] : '')
            ->setAmount(isset($data['amount']) ? $data['amount'] : 0)
            ->setStatus(isset($data['status']) ? $data['status'] : '')
            ->setSettlementSummary(
                (new SettlementSummary())->fromArray(isset($data['settlement_summary']) ? $data['settlement_summary'] : [])
            );

        if (isset($data['_links'])) {
            foreach ($data['_links'] as $linkName => $link) {
                if ($linkName === 'payment') {
                    $paymentId = str_replace('https://publicapi.payments.service.gov.uk/v1/payments/', '', $link['href']);
                    $this->setPaymentId($paymentId);
                }
            }
        }

        return $this;
    }
}