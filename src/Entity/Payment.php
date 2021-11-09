<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class Payment implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $createdDate = '';

    /**
     * @var int
     */
    private $amount = 0;

    /**
     * @var PaymentState
     */
    private $state;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $reference = '';

    /**
     * @var string
     */
    private $language = '';

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var CardDetails
     */
    private $cardDetails;

    /**
     * @var RefundSummary
     */
    private $refundSummary;

    /**
     * @var SettlementSummary
     */
    private $settlementSummary;

    /**
     * @var bool
     */
    private $delayedCapture = false;

    /**
     * @var bool
     */
    private $moto = false;

    /**
     * @var int
     */
    private $corporateCardSurcharge = 0;

    /**
     * @var int
     */
    private $totalAmount = 0;

    /**
     * @var int
     */
    private $fee = 0;

    /**
     * @var int
     */
    private $netAmount = 0;

    /**
     * @var string
     */
    private $paymentProvider = '';

    /**
     * @var string
     */
    private $providerId = '';

    /**
     * @var string
     */
    private $paymentId = '';

    /**
     * @var AuthorisationSummary
     */
    private $authorisationSummary;

    /**
     * @var string
     */
    private $returnUrl = '';

    /**
     * @var Link[]
     */
    private $links = [];

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     * @return Payment
     */
    public function setCreatedDate(string $createdDate): Payment
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
     * @return Payment
     */
    public function setAmount(int $amount): Payment
    {
        $this->amount = $amount;
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
     * @return Payment
     */
    public function setState(PaymentState $state): Payment
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Payment
     */
    public function setDescription(string $description): Payment
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Payment
     */
    public function setReference(string $reference): Payment
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Payment
     */
    public function setLanguage(string $language): Payment
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Payment
     */
    public function setData(array $data): Payment
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Payment
     */
    public function setEmail(string $email): Payment
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return CardDetails
     */
    public function getCardDetails(): CardDetails
    {
        return $this->cardDetails;
    }

    /**
     * @param CardDetails $cardDetails
     * @return Payment
     */
    public function setCardDetails(CardDetails $cardDetails): Payment
    {
        $this->cardDetails = $cardDetails;
        return $this;
    }

    /**
     * @return RefundSummary
     */
    public function getRefundSummary(): RefundSummary
    {
        return $this->refundSummary;
    }

    /**
     * @param RefundSummary $refundSummary
     * @return Payment
     */
    public function setRefundSummary(RefundSummary $refundSummary): Payment
    {
        $this->refundSummary = $refundSummary;
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
     * @return Payment
     */
    public function setSettlementSummary(SettlementSummary $settlementSummary): Payment
    {
        $this->settlementSummary = $settlementSummary;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDelayedCapture(): bool
    {
        return $this->delayedCapture;
    }

    /**
     * @param bool $delayedCapture
     * @return Payment
     */
    public function setDelayedCapture(bool $delayedCapture): Payment
    {
        $this->delayedCapture = $delayedCapture;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMoto(): bool
    {
        return $this->moto;
    }

    /**
     * @param bool $moto
     * @return Payment
     */
    public function setMoto(bool $moto): Payment
    {
        $this->moto = $moto;
        return $this;
    }

    /**
     * @return int
     */
    public function getCorporateCardSurcharge(): int
    {
        return $this->corporateCardSurcharge;
    }

    /**
     * @param int $corporateCardSurcharge
     * @return Payment
     */
    public function setCorporateCardSurcharge(int $corporateCardSurcharge): Payment
    {
        $this->corporateCardSurcharge = $corporateCardSurcharge;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     * @return Payment
     */
    public function setTotalAmount(int $totalAmount): Payment
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
    }

    /**
     * @param int $fee
     * @return Payment
     */
    public function setFee(int $fee): Payment
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * @return int
     */
    public function getNetAmount(): int
    {
        return $this->netAmount;
    }

    /**
     * @param int $netAmount
     * @return Payment
     */
    public function setNetAmount(int $netAmount): Payment
    {
        $this->netAmount = $netAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentProvider(): string
    {
        return $this->paymentProvider;
    }

    /**
     * @param string $paymentProvider
     * @return Payment
     */
    public function setPaymentProvider(string $paymentProvider): Payment
    {
        $this->paymentProvider = $paymentProvider;
        return $this;
    }

    /**
     * @return string
     */
    public function getProviderId(): string
    {
        return $this->providerId;
    }

    /**
     * @param string $providerId
     * @return Payment
     */
    public function setProviderId(string $providerId): Payment
    {
        $this->providerId = $providerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     * @return Payment
     */
    public function setPaymentId(string $paymentId): Payment
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return AuthorisationSummary
     */
    public function getAuthorisationSummary(): AuthorisationSummary
    {
        return $this->authorisationSummary;
    }

    /**
     * @param AuthorisationSummary $authorisationSummary
     * @return Payment
     */
    public function setAuthorisationSummary(AuthorisationSummary $authorisationSummary): Payment
    {
        $this->authorisationSummary = $authorisationSummary;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     * @return Payment
     */
    public function setReturnUrl(string $returnUrl): Payment
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     * @return Payment
     */
    public function setLinks(array $links): Payment
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @param array $data
     * @return Payment
     */
    public function fromArray(array $data): Payment
    {
        $this->setCreatedDate(isset($data['created_date']) ? $data['created_date'] : '');
        $this->setAmount(isset($data['amount']) ? $data['amount'] : 0);
        $this->setState(
            (new PaymentState())->fromArray(isset($data['state']) ? $data['state'] : [])
        );
        $this->setDescription(isset($data['description']) ? $data['description'] : '');
        $this->setReference(isset($data['reference']) ? $data['reference'] : '');
        $this->setLanguage(isset($data['language']) ? $data['language'] : 'en');
        $this->setData(isset($data['metadata']) ? $data['metadata'] : []);
        $this->setEmail(isset($data['email']) ? $data['email'] : '');
        $this->setCardDetails(
            (new CardDetails())->fromArray(isset($data['card_details']) ? $data['card_details'] : [])
        );
        $this->setRefundSummary(
            (new RefundSummary())->fromArray(isset($data['refund_summary']) ? $data['refund_summary'] : [])
        );
        $this->setSettlementSummary(
            (new SettlementSummary())->fromArray(isset($data['settlement_summary']) ? $data['settlement_summary'] : [])
        );
        $this->setDelayedCapture(isset($data['delayed_capture']) ? $data['delayed_capture'] : false);
        $this->setMoto(isset($data['moto']) ? $data['moto'] : false);
        $this->setCorporateCardSurcharge(isset($data['corporate_card_surcharge']) ? $data['corporate_card_surcharge'] : 0);
        $this->setTotalAmount(isset($data['total_amount']) ? $data['total_amount'] : 0);
        $this->setFee(isset($data['fee']) ? $data['fee'] : 0);
        $this->setNetAmount(isset($data['net_amount']) ? $data['net_amount'] : 0);
        $this->setPaymentProvider(isset($data['payment_provider']) ? $data['payment_provider'] : '');
        $this->setProviderId(isset($data['provider_id']) ? $data['provider_id'] : '');
        $this->setPaymentId(isset($data['payment_id']) ? $data['payment_id'] : '');
        $this->setAuthorisationSummary(
            (new AuthorisationSummary())->fromArray(isset($data['authorisation_summary']) ? $data['authorisation_summary'] : [])
        );
        $this->setReturnUrl(isset($data['return_url']) ? $data['return_url'] : '');

        $links = [];
        if (isset($data['_links'])) {
            foreach ($data['_links'] as $linkName => $link) {
                $link = (new Link())
                    ->setName($linkName)
                    ->setHref(isset($link['href']) ? $link['href'] : '')
                    ->setMethod(isset($link['method']) ? $link['method'] : '')
                    ->setParams(isset($link['params']) ? $link['params'] : [])
                    ->setType(isset($link['type']) ? $link['type'] : '');
                $links[] = $link;
            }
        }
        $this->setLinks($links);

        return $this;
    }
}