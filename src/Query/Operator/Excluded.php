<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Operator;

use function SolariumSpecification\excluded;
use SolariumSpecification\Query\QueryInterface;

class Excluded implements QueryInterface
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
    public function getQueryString(): string
    {
        return excluded($this->query->getQueryString());
    }
}
