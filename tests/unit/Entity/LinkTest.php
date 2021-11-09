<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\GovPay\Entity\Link;
use Tests\Unit\AbstractTestCase;

class LinkTest extends AbstractTestCase
{
    /**
     * @var Link
     */
    private $link;

    public function setUp(): void
    {
        $this->link = new Link();
        parent::setUp();
    }

    public function testThatEntityLoadsWithEmptyArray()
    {
        $result = $this->link->fromArray([]);
        $this->assertInstanceOf(Link::class, $result);
    }

    public function testThatEntityLoadsRefundSummaryDataCorrectly()
    {
        $result = $this->link->fromArray(
            [
                'name' => 'Name of link',
                'type' => 'Link type',
                'params' => [
                    'page' => 1
                ],
                'href' => 'https://test.url',
                'method' => 'GET',
            ]
        );
        $this->assertEquals('Name of link', $result->getName());
        $this->assertEquals('Link type', $result->getType());
        $this->assertEquals(['page' => 1], $result->getParams());
        $this->assertEquals('https://test.url', $result->getHref());
        $this->assertEquals('GET', $result->getMethod());
    }
}