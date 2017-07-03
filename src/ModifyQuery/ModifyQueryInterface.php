<?php

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;

/**
 * Modify query interface
 */
interface ModifyQueryInterface
{
    /**
     * Modify a query
     *
     * @param Query $query
     *
     * @return ModifyQueryInterface
     */
    public function modify(Query $query): self;
}
