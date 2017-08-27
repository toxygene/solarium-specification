<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Operator;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\excluded;

class Excluded implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * Constructor
     *
     * @param QueryInterface $query
     */
    public function __construct(QueryInterface $query)
    {
        $this->query = $query;
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
        return excluded($this->query->getQueryString());
    }
}
