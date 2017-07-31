<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Operator;

use function SolariumSpecification\defaultX;
use SolariumSpecification\Query\QueryInterface;

class DefaultX implements QueryInterface
{
    /**
     * @var QueryInterface[]
     */
    private $queries;

    /**
     * Constructor
     *
     * @param QueryInterface[] $queries
     */
    public function __construct($queries = [])
    {
        $this->queries = $queries;
    }

    /**
     * Append a query
     *
     * @param QueryInterface $query
     * @return self
     */
    public function append(QueryInterface $query)
    {
        $this->queries[] = $query;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getString(): string
    {
        return defaultX(
            array_map(
                function(QueryInterface $query) {
                    return $query->getString();
                },
                $this->queries
            )
        );
    }
}
