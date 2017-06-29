<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Document\DocumentInterface;
use Solarium\QueryType\Select\Result\Result;

/**
 * Interface for a Solarium specification repository
 */
interface SpecificationRepositoryInterface
{
    /**
     * Match all results
     *
     * @param SpecificationInterface $specification
     * @return ResultInterface[]
     */
    public function match(SpecificationInterface $specification);
}
