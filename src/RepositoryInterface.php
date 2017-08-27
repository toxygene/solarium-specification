<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Result\Result;

/**
 * Interface for a Solarium specification repository
 */
interface RepositoryInterface
{
    /**
     * Match all results
     *
     * @param QuerySpecificationInterface|null $query
     * @param ModifyQueryInterface|null $modifyQuery
     *
     * @return Result
     */
    public function match(
        QuerySpecificationInterface $query = null,
        ModifyQueryInterface $modifyQuery = null
    ): Result;
}
