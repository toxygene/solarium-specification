<?php

declare(strict_types=1);

namespace SolariumSpecification;

interface ModifyQuerySpecificationInterface
{
    /**
     * Get the modify query
     *
     * @return ModifyQueryInterface
     */
    public function getModifyQuery(): ModifyQueryInterface;
}
