<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\Query\QueryInterface;

/**
 * Interface for a Solarium specification repository
 */
interface RepositoryInterface
{
    /**
     * Match all results
     *
     * @param QueryInterface|null $query
     * @param ModifyQueryInterface|null $modifyQuery
     *
     * @return Result
     */
    public function match(
        QueryInterface $query = null,
        ModifyQueryInterface $modifyQuery = null
    ): Result;
}
