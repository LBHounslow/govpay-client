<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class PaymentState implements ArrayToEntityInterface
{
    const SUCCESS = 'success';
    const FAILED = 'failed';

    const VALID_STATES = [
        self::SUCCESS,
        self::FAILED
    ];

    /**
     * @var string
     */
    private $status = '';

    /**
     * @var bool
     */
    private $finished = false;

    /**
     * @var string
     */
    private $message = '';

    /**
     * @var string
     */
    private $code = '';

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return PaymentState
     */
    public function setStatus(string $status): PaymentState
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->finished;
    }

    /**
     * @param bool $finished
     * @return PaymentState
     */
    public function setFinished(bool $finished): PaymentState
    {
        $this->finished = $finished;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return PaymentState
     */
    public function setMessage(string $message): PaymentState
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return PaymentState
     */
    public function setCode(string $code): PaymentState
    {
        $this->code = $code;
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
            ->setFinished(isset($data['finished']) ? $data['finished'] : false)
            ->setMessage(isset($data['message']) ? $data['message'] : '')
            ->setCode(isset($data['code']) ? $data['code'] : '');
        return $this;
    }
}
