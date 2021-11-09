<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\Payment;
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