<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Operator;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\excluded;

class Excluded implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var QuerySpecificationInterface
     */
    private $query;

    /**
     * Constructor
     *
     * @param QuerySpecificationInterface  $query
     */
    public function __construct(QuerySpecificationInterface $query)
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
        return excluded($this->query->getQuery()->getQueryString());
    }
}
