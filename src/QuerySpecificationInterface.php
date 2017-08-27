<?php

declare(strict_types=1);

namespace SolariumSpecification;

interface QuerySpecificationInterface
{
    /**
     * Get the query for the specification
     *
     * @return QueryInterface
     */
    public function getQuery(): QueryInterface;
}
