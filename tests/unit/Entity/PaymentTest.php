<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\AuthorisationSummary;
use LBHounslow\GovPay\Entity\CardDetails;
use LBHounslow\GovPay\Entity\Link;
use LBHounslow\GovPay\Entity\Payment;
use LBHounslow\GovPay\Entity\PaymentState;
use LBHounslow\GovPay\Entity\RefundSummary;
use LBHounslow\GovPay\Entity\SettlementSummary;
use Tests\Unit\AbstractTestCase;

class PaymentTest extends AbstractTestCase
{
    /**
     * @var Payment
     */
    private $payment;

    public function setUp(): void
    {
        $this->payment = new Payment();
        parent::setUp();
    }

    public function testSettersAndGetters()
    {
        $this->payment->setCreatedDate('2022-02-09 00:00:00');
        $this->assertEquals('2022-02-09 00:00:00', $this->payment->getCreatedDate());

        $this->payment->setAmount(123);
        $this->assertEquals(123, $this->payment->getAmount());

        $this->payment->setState(new PaymentState());
        $this->assertInstanceOf(PaymentState::class, $this->payment->getState());

        $this->payment->setDescription('description');
        $this->assertEquals('description', $this->payment->getDescription());

        $this->payment->setReference('payment-ref');
        $this->assertEquals('payment-ref', $this->payment->getReference());

        $this->payment->setLanguage('en');
        $this->assertEquals('en', $this->payment->getLanguage());

        $this->payment->setData([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $this->payment->getData());

        $this->payment->setEmail('test@domain.com');
        $this->assertEquals('test@domain.com', $this->payment->getEmail());

        $this->payment->setCardDetails(new CardDetails());
        $this->assertInstanceOf(CardDetails::class, $this->payment->getCardDetails());

        $this->payment->setRefundSummary(new RefundSummary());
        $this->assertInstanceOf(RefundSummary::class, $this->payment->getRefundSummary());

        $this->payment->setSettlementSummary(new SettlementSummary());
        $this->assertInstanceOf(SettlementSummary::class, $this->payment->getSettlementSummary());

        $this->payment->setDelayedCapture(true);
        $this->assertTrue($this->payment->isDelayedCapture());

        $this->payment->setMoto(true);
        $this->assertTrue($this->payment->isMoto());

        $this->payment->setCorporateCardSurcharge(123);
        $this->assertEquals(123, $this->payment->getCorporateCardSurcharge());

        $this->payment->setTotalAmount(123);
        $this->assertEquals(123, $this->payment->getTotalAmount());

        $this->payment->setFee(123);
        $this->assertEquals(123, $this->payment->getFee());

        $this->payment->setNetAmount(123);
        $this->assertEquals(123, $this->payment->getNetAmount());

        $this->payment->setPaymentProvider('payment-provider');
        $this->assertEquals('payment-provider', $this->payment->getPaymentProvider());

        $this->payment->setProviderId('provider-id');
        $this->assertEquals('provider-id', $this->payment->getProviderId());

        $this->payment->setPaymentId('payment-id');
        $this->assertEquals('payment-id', $this->payment->getPaymentId());

        $this->payment->setAuthorisationSummary(new AuthorisationSummary());
        $this->assertInstanceOf(AuthorisationSummary::class, $this->payment->getAuthorisationSummary());

        $this->payment->setReturnUrl('https://test.url');
        $this->assertEquals('https://test.url', $this->payment->getReturnUrl());

        $this->payment->setLinks([(new Link())->setHref('https://test.url')]);
        $this->assertEquals([(new Link())->setHref('https://test.url')], $this->payment->getLinks());
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->payment->fromArray([]);
        $this->assertInstanceOf(Payment::class, $result);
    }

    public function testThatEntityLoadsPaymentDataCorrectly()
    {
        $result = $this->payment->fromArray(self::PAYMENT_ARRAY);
        $this->assertEquals(self::PAYMENT_CREATED_DATE, $result->getCreatedDate());
        $this->assertEquals(self::PAYMENT_AMOUNT, $result->getAmount());
        $this->assertEquals(self::PAYMENT_STATE_STATUS, $result->getState()->getStatus());
        $this->assertEquals(self::PAYMENT_STATE_FINISHED, $result->getState()->isFinished());
        $this->assertEquals(self::PAYMENT_STATE_MESSAGE, $result->getState()->getMessage());
        $this->assertEquals(self::PAYMENT_STATE_CODE, $result->getState()->getCode());
        $this->assertEquals(self::PAYMENT_DESCRIPTION, $result->getDescription());
        $this->assertEquals(self::PAYMENT_REFERENCE, $result->getReference());
        $this->assertEquals(self::PAYMENT_LANGUAGE, $result->getLanguage());
        $this->assertEquals(self::PAYMENT_METADATA_LEDGER_CODE_VALUE, $result->getData()[self::PAYMENT_METADATA_LEDGER_CODE_KEY]);
        $this->assertEquals(self::PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_VALUE, $result->getData()[self::PAYMENT_METADATA_AN_INTERNAL_REFERENCE_NUMBER_KEY]);
        $this->assertEquals(self::PAYMENT_EMAIL, $result->getEmail());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_BRAND, $result->getCardDetails()->getCardBrand());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_TYPE, $result->getCardDetails()->getCardType());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER, $result->getCardDetails()->getLastDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER, $result->getCardDetails()->getFirstDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_EXPIRY_DATE, $result->getCardDetails()->getExpiryDate());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME, $result->getCardDetails()->getCardHolderName());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1, $result->getCardDetails()->getCardBillingAddress()->getLine1());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2, $result->getCardDetails()->getCardBillingAddress()->getLine2());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE, $result->getCardDetails()->getCardBillingAddress()->getPostCode());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY, $result->getCardDetails()->getCardBillingAddress()->getCity());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY, $result->getCardDetails()->getCardBillingAddress()->getCountry());
        $this->assertEquals(self::PAYMENT_PAYMENT_ID, $result->getPaymentId());
        $this->assertEquals(self::PAYMENT_AUTHORISATION_SUMMARY_THREE_D_SECURE_REQUIRED, $result->getAuthorisationSummary()->isThreeDSecureRequired());
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_STATUS, $result->getRefundSummary()->getStatus());
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_AMOUNT_AVAILABLE, $result->getRefundSummary()->getAmountAvailable());
        $this->assertEquals(self::PAYMENT_REFUND_SUMMARY_AMOUNT_SUBMITTED, $result->getRefundSummary()->getAmountSubmitted());
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURE_SUBMIT_TIME, $result->getSettlementSummary()->getCaptureSubmitTime());
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_CAPTURED_DATE, $result->getSettlementSummary()->getCapturedDate());
        $this->assertEquals(self::PAYMENT_SETTLEMENT_SUMMARY_SETTLED_DATE, $result->getSettlementSummary()->getSettledDate());
        $this->assertEquals(self::PAYMENT_DELAYED_CAPTURE, $result->isDelayedCapture());
        $this->assertEquals(self::PAYMENT_MOTO, $result->isMoto());
        $this->assertEquals(self::PAYMENT_CORPORATE_CARD_SURCHARGE, $result->getCorporateCardSurcharge());
        $this->assertEquals(self::PAYMENT_TOTAL_AMOUNT, $result->getTotalAmount());
        $this->assertEquals(self::PAYMENT_FEE, $result->getFee());
        $this->assertEquals(self::PAYMENT_NET_AMOUNT, $result->getNetAmount());
        $this->assertEquals(self::PAYMENT_PAYMENT_PROVIDER, $result->getPaymentProvider());
        $this->assertEquals(self::PAYMENT_PROVIDER_ID, $result->getProviderId());
        $this->assertEquals(self::PAYMENT_RETURN_URL, $result->getReturnUrl());
    }
}