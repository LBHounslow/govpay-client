<?php

declare(strict_types=1);

namespace Tests\Unit\Builder;

use LBHounslow\GovPay\Builder\QueryStringBuilder;
use LBHounslow\GovPay\Entity\CardDetails;
use Tests\Unit\AbstractTestCase;

class QueryStringBuilderTest extends AbstractTestCase
{
    /**
     * @var QueryStringBuilder
     */
    private $queryStringBuilder;

    public function setUp(): void
    {
        $this->queryStringBuilder = new QueryStringBuilder();
        parent::setUp();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetters()
    {
        $this->queryStringBuilder->setPage(1);
        $this->queryStringBuilder->setPerPage(20);
        $this->queryStringBuilder->setFromDate('2022-02-09 00:00:00');
        $this->queryStringBuilder->setToDate('2022-02-10 00:00:00');
        $this->queryStringBuilder->setFromSettledDate('2022-02-09');
        $this->queryStringBuilder->setToSettledDate('2022-02-10');
        $this->queryStringBuilder->setEmail('test@domain.com');
        $this->queryStringBuilder->setReference('reference-123');
        $this->queryStringBuilder->setState('success');
        $this->queryStringBuilder->setCardBrand('visa');
        $this->queryStringBuilder->setCardholderName('Test Person');
        $this->queryStringBuilder->setFirstDigitsCardNumber('1234');
        $this->queryStringBuilder->setLastDigitsCardNumber('7890');
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param string $expectedQueryString
     * @dataProvider attributeAndReturnsCorrectQueryStringDataProvider
     */
    public function testItSetsAttributeAndReturnsCorrectQueryString(string $attribute, $value, string $expectedQueryString)
    {
        $this->assertClassHasAttribute($attribute, QueryStringBuilder::class);
        $setter = 'set' . ucfirst($attribute);
        $result = $this->queryStringBuilder->$setter($value)->build();
        $this->assertEquals($expectedQueryString, $result);
    }

    public function attributeAndReturnsCorrectQueryStringDataProvider()
    {
        return [
            ['page', 1, '?page=1&display_size=500'],
            ['perPage', 50, '?page=1&display_size=50'],
            ['fromDate', self::FROM_DATE_MYSQL, sprintf('?page=1&display_size=500&from_date=%s', self::FROM_DATE_UTC)],
            ['toDate', self::TO_DATE_MYSQL, sprintf('?page=1&display_size=500&to_date=%s', self::TO_DATE_UTC)],
            ['fromSettledDate', self::FROM_DATE_MYSQL, sprintf('?page=1&display_size=500&from_settled_date=%s', self::FROM_DATE_UTC)],
            ['toSettledDate', self::TO_DATE_MYSQL, sprintf('?page=1&display_size=500&to_settled_date=%s', self::TO_DATE_UTC)],
            ['email', self::PAYMENT_EMAIL, '?page=1&display_size=500&email=test.person%40domain.com'],
            ['reference', self::PAYMENT_REFERENCE, '?page=1&display_size=500&reference=12345'],
            ['cardBrand', CardDetails::VISA, '?page=1&display_size=500&card_brand=visa'],
            ['cardholderName', self::PAYMENT_CARD_DETAILS_CARDHOLDER_NAME, '?page=1&display_size=500&cardholder_name=Test+Person'],
            ['firstDigitsCardNumber', self::PAYMENT_CARD_DETAILS_FIRST_DIGITS_CARD_NUMBER, '?page=1&display_size=500&first_digits_card_number=123456'],
            ['lastDigitsCardNumber', self::PAYMENT_CARD_DETAILS_LAST_DIGITS_CARD_NUMBER, '?page=1&display_size=500&last_digits_card_number=1234'],
        ];
    }
}