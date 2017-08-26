<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

use function SolariumSpecification\group;

class Group implements QueryInterface
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
        return group($this->query->getQueryString());
    }
}
