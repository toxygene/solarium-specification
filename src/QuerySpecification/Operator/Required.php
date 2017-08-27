<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Operator;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\required;

class Required implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var bool
     */
    private $autoGroup;

    /**
     * Constructor
     *
     * @param QueryInterface $query
     * @param bool $autoGroup
     */
    public function __construct(QueryInterface $query, bool $autoGroup = true)
    {
        $this->query = $query;
        $this->autoGroup = $autoGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery(): QueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return required($this->query->getQueryString());
    }
}
