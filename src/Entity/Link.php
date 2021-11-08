<?php

declare(strict_types=1);

namespace LBHounslow\GovPay\Entity;

class Link implements ArrayToEntityInterface
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $type = '';

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var string
     */
    private $href = '';

    /**
     * @var string
     */
    private $method = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Link
     */
    public function setName(string $name): Link
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Link
     */
    public function setType(string $type): Link
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Link
     */
    public function setParams(array $params): Link
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return Link
     */
    public function setHref(string $href): Link
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Link
     */
    public function setMethod(string $method): Link
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this
            ->setName(isset($data['name']) ? $data['name'] : '')
            ->setType(isset($data['type']) ? $data['type'] : '')
            ->setParams(isset($data['params']) ? $data['params'] : [])
            ->setHref(isset($data['href']) ? $data['href'] : '')
            ->setMethod(isset($data['method']) ? $data['method'] : '');
        return $this;
    }
}
