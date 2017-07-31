<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Modifiers;

use function SolariumSpecification\boost;
use SolariumSpecification\Query\QueryInterface;

class Boost implements QueryInterface
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
    public function getString(): string
    {
        return boost(
            $this->query->getString(),
            $this->amount
        );
    }
}
