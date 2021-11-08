<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\Repository;

use LBHounslow\GovPay\Entity\CardDetails;
use LBHounslow\GovPay\Entity\PaymentState;
use LBHounslow\GovPay\Exception\ValidationException;
use LBHounslow\GovPay\Validator\Repository\QueryStringValidator;
use Tests\Unit\AbstractTestCase;

class QueryStringValidatorTest extends AbstractTestCase
{
    /**
     * @var QueryStringValidator
     */
    private $queryStringValidator;

    public function setUp(): void
    {
        $this->queryStringValidator = new QueryStringValidator();
        parent::setUp();
    }

    /**
     * @param $value
     * @dataProvider invalidDateProvider
     */
    public function testThatIsValidDateThrowsExceptionForInvalidDates($value)
    {
        $this->expectException(ValidationException::class);
        $this->queryStringValidator->isValidDate($value);
    }

    public function invalidDateProvider()
    {
        return [
            [''],
            ['random string'],
            ['08-11-2021'],
            ['2021-11-08'],
            ['8th November 2021'],
            ['2021-11-07T14:08:26.988Z']
        ];
    }

    public function testThatIsDateReturnsTrueForValidMySqlDate()
    {
        $this->assertTrue($this->queryStringValidator->isValidDate('2021-11-08 11:14:25'));
    }

    public function testThatIsValidPaymentStateFailsForInvalidPaymentState()
    {
        $this->expectException(ValidationException::class);
        $this->queryStringValidator->isValidPaymentState('invalid-state');
    }

    /**
     * @param string $state
     * @dataProvider validPaymentStateDataProvider
     */
    public function testThatIsValidPaymentStateReturnsTrueForValidPaymentStates(string $state)
    {
        $this->assertTrue($this->queryStringValidator->isValidPaymentState($state));
    }

    public function validPaymentStateDataProvider()
    {
        return [
            [PaymentState::SUCCESS],
            [PaymentState::FAILED]
        ];
    }

    /**
     * @param string $email
     * @dataProvider invalidDateProvider
     */
    public function testThatIsValidEmailFailsForInvalidEmail(string $email)
    {
        $this->expectException(ValidationException::class);
        $this->queryStringValidator->isValidPaymentState($email);
    }

    public function invalidEmailDataProvider()
    {
        return [
            [''],
            ['random string'],
            ['test@domain.invalid'],
            ['name.surname@domain.x'],
            ['name.middle-name.surname@sub.domain']
        ];
    }

    /**
     * @param string $email
     * @dataProvider validEmailDataProvider
     */
    public function testThatIsValidEmailReturnsTrueForValidEmail(string $email)
    {
        $this->assertTrue($this->queryStringValidator->isValidEmail($email));
    }

    public function validEmailDataProvider()
    {
        return [
            ['test@domain.com'],
            ['first-name.second-name@domain.com'],
            ['my.name@sub.domain.com']
        ];
    }

    /**
     * @param string $cardBrand
     * @dataProvider invalidCardBrandDataProvider
     */
    public function testThatIsValidCardBrandFailsForInvalidCardBrand(string $cardBrand)
    {
        $this->expectException(ValidationException::class);
        $this->queryStringValidator->isValidCardBrand($cardBrand);
    }

    public function invalidCardBrandDataProvider()
    {
        return [
            [''],
            ['invalid-card-brand']
        ];
    }

    /**
     * @param string $cardBrand
     * @dataProvider validCardBrandDataProvider
     */
    public function testThatIsValidCardBrandReturnsTrueForValidCardBrands(string $cardBrand)
    {
        $this->assertTrue($this->queryStringValidator->isValidCardBrand($cardBrand));
    }

    public function validCardBrandDataProvider()
    {
        return [
            [CardDetails::AMERICAN_EXPRESS],
            [CardDetails::DINERS_CLUB],
            [CardDetails::DISCOVER],
            [CardDetails::JCB],
            [CardDetails::MAESTRO],
            [CardDetails::MASTERCARD],
            [CardDetails::UNION_PAY],
            [CardDetails::VISA]
        ];
    }
}