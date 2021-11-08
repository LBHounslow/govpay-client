<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\CardBillingAddress;
use Tests\Unit\AbstractTestCase;

class CardBillingAddressTest extends AbstractTestCase
{
    /**
     * @var CardBillingAddress
     */
    private $cardBillingAddress;

    public function setUp(): void
    {
        $this->cardBillingAddress = new CardBillingAddress();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->cardBillingAddress->fromArray([]);
        $this->assertInstanceOf(CardBillingAddress::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->cardBillingAddress->fromArray(
            [
                'line1' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1,
                'line2' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2,
                'postcode' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE,
                'city' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY,
                'country' => self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY,
            ]
        );
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_1, $result->getLine1());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_LINE_2, $result->getLine2());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_POSTCODE, $result->getPostCode());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_CITY, $result->getCity());
        $this->assertEquals(self::PAYMENT_CARD_DETAILS_BILLING_ADDRESS_COUNTRY, $result->getCountry());
    }
}