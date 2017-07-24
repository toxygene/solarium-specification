<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\SpecificationInterface as ModifyQuerySpecificationInterface;
use SolariumSpecification\Term\SpecificationInterface as TermSpecificationInterface;

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
