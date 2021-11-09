<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\CardDetails;
use Tests\Unit\AbstractTestCase;

class CardDetailsTest extends AbstractTestCase
{
    /**
     * @var CardDetails
     */
    private $cardDetails;

    public function setUp(): void
    {
        $this->cardDetails = new CardDetails();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->cardDetails->fromArray([]);
        $this->assertInstanceOf(CardDetails::class, $result);
    }

    public function testThatEntityLoadsCardDetailsDataCorrectly()
    {
        $result = $this->cardDetails->fromArray(
            [
                'card_brand' => self::PAYMENT_CARD_DETAILS_CARD_BRAND,
                'card_type' => self::PAYMENT_CARD_DETAILS_CARD_TYPE,
                'last_digits_card_number' => self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER,
                'first_digits_card_number' => self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER,
                'expiry_date' => self::PAYMENT_CARD_DETAILS_EXPIRY_DATE,
                'cardholder_name' => self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME,
            ]
        );
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_BRAND, $result->getCardBrand());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_TYPE, $result->getCardType());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER, $result->getLastDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER, $result->getFirstDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_EXPIRY_DATE, $result->getExpiryDate());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME, $result->getCardHolderName());
    }

    public function testThatEntityLoadsCardDetailsAndBillingAddressDataCorrectly()
    {
        $result = $this->cardDetails->fromArray(
            [
                'card_brand' => self::PAYMENT_CARD_DETAILS_CARD_BRAND,
                'card_type' => self::PAYMENT_CARD_DETAILS_CARD_TYPE,
                'last_digits_card_number' => self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER,
                'first_digits_card_number' => self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER,
                'expiry_date' => self::PAYMENT_CARD_DETAILS_EXPIRY_DATE,
                'cardholder_name' => self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME,
                'billing_address' => [
                    'line1' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1,
                    'line2' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2,
                    'postcode' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE,
                    'city' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY,
                    'country' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY,
                ],
            ]
        );
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_BRAND, $result->getCardBrand());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARD_TYPE, $result->getCardType());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER, $result->getLastDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER, $result->getFirstDigitsCardNumber());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_EXPIRY_DATE, $result->getExpiryDate());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME, $result->getCardHolderName());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1, $result->getCardBillingAddress()->getLine1());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2, $result->getCardBillingAddress()->getLine2());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE, $result->getCardBillingAddress()->getPostCode());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY, $result->getCardBillingAddress()->getCity());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY, $result->getCardBillingAddress()->getCountry());
    }
}