<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Interface for creating a filter specification
 */
interface FilterInterface
{
    /**
     * Return a filter string
     *
     * @param Query $query
     * @return string
     */
    public function getFilter(Query $query): string;
}
