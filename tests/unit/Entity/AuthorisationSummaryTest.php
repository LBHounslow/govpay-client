<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\AuthorisationSummary;
use Tests\Unit\AbstractTestCase;

class AuthorisationSummaryTest extends AbstractTestCase
{
    /**
     * @var AuthorisationSummary
     */
    private $authorisationSummary;

    public function setUp(): void
    {
        $this->authorisationSummary = new AuthorisationSummary();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->authorisationSummary->fromArray([]);
        $this->assertInstanceOf(AuthorisationSummary::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->authorisationSummary->fromArray(
            [
                'three_d_secure' => [
                    'required' => self::PAYMENT_AUTHORISATION_SUMMARY_THREE_D_SECURE_REQUIRED,
                ],
            ]
        );
        $this->assertEquals(self::PAYMENT_AUTHORISATION_SUMMARY_THREE_D_SECURE_REQUIRED, $result->isThreeDSecureRequired());
    }
}