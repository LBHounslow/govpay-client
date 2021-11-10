<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use LBHounslow\GovPay\Entity\PaginatedResults;
use LBHounslow\GovPay\Enum\HttpStatusCodeEnum;
use LBHounslow\GovPay\Response\ApiResponse;
use Tests\Unit\AbstractTestCase;

class PaginatedResultsTest extends AbstractTestCase
{
    /**
     * @var PaginatedResults
     */
    private $paginatedResults;

    public function setUp(): void
    {
        $this->paginatedResults = new PaginatedResults();
        parent::setUp();
    }

    public function testItThrowsExceptionForNonPaginatedResults()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->paginatedResults->fromArray(['invalid' => 'array', 'structure']);
    }

    public function testItSetsAttributesCorrectlyForEmptySearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::SEARCH_RESULTS_EMPTY_ARRAY))
        );
        /** @var PaginatedResults $result */
        $result = $this->paginatedResults->fromArray($apiResponse->getBody());
        $this->assertEquals(0, $result->getTotal());
        $this->assertEquals(0, $result->getCount());
        $this->assertEquals(1, $result->getPage());
        $this->assertEquals([], $result->getResults());
        $this->assertEmpty($result->getCurrentPageUri());
        $this->assertEmpty($result->getFirstPageUri());
        $this->assertEmpty($result->getPrevPageUri());
        $this->assertEmpty($result->getNextPageUri());
        $this->assertEmpty($result->getLastPageUri());
    }

    public function testItSetsAttributesCorrectlyForValidApiSearchResponse()
    {
        $apiResponse = new ApiResponse(
            new GuzzleResponse(HttpStatusCodeEnum::OK, [], json_encode(self::PAYMENT_SEARCH_RESULTS_ARRAY))
        );
        /** @var PaginatedResults $result */
        $result = $this->paginatedResults->fromArray($apiResponse->getBody());
        $this->assertEquals(self::SEARCH_RESULTS_TOTAL, $result->getTotal());
        $this->assertEquals(self::SEARCH_RESULTS_COUNT, $result->getCount());
        $this->assertEquals(self::SEARCH_RESULTS_PAGE, $result->getPage());
        $this->assertEquals(self::SEARCH_LINKS_SELF_HREF, $result->getCurrentPageUri());
        $this->assertEquals(self::SEARCH_LINKS_FIRST_HREF, $result->getFirstPageUri());
        $this->assertEquals(self::SEARCH_LINKS_PREV_HREF, $result->getPrevPageUri());
        $this->assertEquals(self::SEARCH_LINKS_NEXT_HREF, $result->getNextPageUri());
        $this->assertEquals(self::SEARCH_LINKS_LAST_HREF, $result->getLastPageUri());
        $this->assertEquals(self::PAYMENT_ARRAY, $result->getResults()[0]);
    }
}