<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Operator;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\not;

class Not implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var QuerySpecificationInterface
     */
    private $contains;

    /**
     * @var QuerySpecificationInterface
     */
    private $excludes;

    /**
     * Constructor
     *
     * @param QuerySpecificationInterface $contains
     * @param QuerySpecificationInterface $excludes
     */
    public function __construct(
        QuerySpecificationInterface $contains,
        QuerySpecificationInterface $excludes
    )
    {
        $this->contains = $contains;
        $this->excludes = $excludes;
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
        return not(
            $this->contains->getQuery()->getQueryString(),
            $this->excludes->getQuery()->getQueryString()
        );
    }
}
