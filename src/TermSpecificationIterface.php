<?php

namespace SolariumSpecification;

use SolariumSpecification\Term\TermInterface;

/**
 * Term specification interface
 */
interface TermSpecificationInterface
{
    /**
     * Get the term for the specification
     *
     * @return TermInterface
     */
    public function getTerm(): TermInterface;
}
