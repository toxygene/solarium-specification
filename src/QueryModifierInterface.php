<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Interface for modifying a query
 */
interface QueryModifierInterface
{
    /**
     * Modify a query
     *
     * @param Query $query
     * @return self
     */
    public function modify(Query $query): self;
}

