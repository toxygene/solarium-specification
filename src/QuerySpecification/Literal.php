<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;

class Literal implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var string
     */
    private $literal;

    /**
     * Constructor
     *
     * @param string $literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
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
        return $this->literal;
    }
}
