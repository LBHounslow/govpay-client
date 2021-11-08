<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class SettlementSummary implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $captureSubmitTime = '';

    /**
     * @var string
     */
    private $capturedDate = '';

    /**
     * @var string
     */
    private $settledDate = '';

    /**
     * @return string
     */
    public function getCaptureSubmitTime(): string
    {
        return $this->captureSubmitTime;
    }

    /**
     * @param string $captureSubmitTime
     * @return SettlementSummary
     */
    public function setCaptureSubmitTime(string $captureSubmitTime): SettlementSummary
    {
        $this->captureSubmitTime = $captureSubmitTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getCapturedDate(): string
    {
        return $this->capturedDate;
    }

    /**
     * @param string $capturedDate
     * @return SettlementSummary
     */
    public function setCapturedDate(string $capturedDate): SettlementSummary
    {
        $this->capturedDate = $capturedDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getSettledDate(): string
    {
        return $this->settledDate;
    }

    /**
     * @param string $settledDate
     * @return SettlementSummary
     */
    public function setSettledDate(string $settledDate): SettlementSummary
    {
        $this->settledDate = $settledDate;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setCaptureSubmitTime(isset($data['capture_submit_time']) ? $data['capture_submit_time'] : '')
            ->setCapturedDate(isset($data['captured_date']) ? $data['captured_date'] : '')
            ->setSettledDate(isset($data['settled_date']) ? $data['settled_date'] : '');
        return $this;
    }
}
