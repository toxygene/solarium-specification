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
     * @param TermSpecificationInterface|null $termSpecification
     * @param ModifyQuerySpecificationInterface|null $modifyQuerySpecification
     *
     * @return Result
     */
    public function match(
        TermSpecificationInterface $termSpecification = null,
        ModifyQuerySpecificationInterface $modifyQuerySpecification = null
    );
}
