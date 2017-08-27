<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Operator;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\andX;

class AndX implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var \SolariumSpecification\QuerySpecificationInterface[]
     */
    private $queries;

    /**
     * Constructor
     *
     * @param \SolariumSpecification\QuerySpecificationInterface[] $queries
     */
    public function __construct($queries = [])
    {
        $this->queries = $queries;
    }

    /**
     * Append a query
     *
     * @param \SolariumSpecification\QuerySpecificationInterface $query
     * @return self
     */
    public function append(QuerySpecificationInterface $query)
    {
        $this->queries[] = $query;

        return $this;
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
        return andX(
            array_map(
                function(QuerySpecificationInterface $query) {
                    return $query->getQuery()
                        ->getQueryString();
                },
                $this->queries
            )
        );
    }
}