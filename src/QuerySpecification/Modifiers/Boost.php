<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Modifiers;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\boost;

class Boost implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var float
     */
    private $amount;

    /**
     * Constructor
     *
     * @param QueryInterface $query
     * @param float $amount
     */
    public function __construct(QueryInterface $query, float $amount)
    {
        $this->query = $query;
        $this->amount = $amount;
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
        return boost(
            $this->query->getQueryString(),
            $this->amount
        );
    }
}
