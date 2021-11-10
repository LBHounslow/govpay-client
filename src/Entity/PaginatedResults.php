<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class PaginatedResults implements ArrayToEntityInterface
{
    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var array
     */
    private $results = [];

    /**
     * @var string
     */
    private $firstPageUri = '';

    /**
     * @var string
     */
    private $currentPageUri = '';

    /**
     * @var string
     */
    private $prevPageUri = '';

    /**
     * @var string
     */
    private $nextPageUri = '';

    /**
     * @var string
     */
    private $lastPageUri = '';

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     * @return PaginatedResults
     */
    public function setResults(array $results): PaginatedResults
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstPageUri(): string
    {
        return $this->firstPageUri;
    }

    /**
     * @return string
     */
    public function getCurrentPageUri(): string
    {
        return $this->currentPageUri;
    }

    /**
     * @return string
     */
    public function getPrevPageUri(): string
    {
        return $this->prevPageUri;
    }

    /**
     * @return string
     */
    public function getNextPageUri(): string
    {
        return $this->nextPageUri;
    }

    /**
     * @return string
     */
    public function getLastPageUri(): string
    {
        return $this->lastPageUri;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        if (
            !isset($data['total'])
            || !isset($data['count'])
            || !isset($data['page'])
        ) {
            throw new \InvalidArgumentException('Missing pagination attributes');
        }
        $this->total = isset($data['total']) ? $data['total'] : $this->total;
        $this->count = isset($data['count']) ? $data['count'] : $this->count;
        $this->page = isset($data['page']) ? $data['page'] : $this->page;
        $this->results = isset($data['results']) ? $data['results'] : $this->results;
        $this->firstPageUri = isset($data['_links']['first_page']['href']) ? $data['_links']['first_page']['href'] : $this->firstPageUri;
        $this->currentPageUri = isset($data['_links']['self']['href']) ? $data['_links']['self']['href'] : $this->currentPageUri;
        $this->prevPageUri = isset($data['_links']['prev_page']['href']) ? $data['_links']['prev_page']['href'] : $this->prevPageUri;
        $this->nextPageUri = isset($data['_links']['next_page']['href']) ? $data['_links']['next_page']['href'] : $this->nextPageUri;
        $this->lastPageUri = isset($data['_links']['last_page']['href']) ? $data['_links']['last_page']['href'] : $this->lastPageUri;

        return $this;
    }
}