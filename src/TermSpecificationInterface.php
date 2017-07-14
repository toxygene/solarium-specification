<?php

namespace SolariumSpecification;

use SolariumSpecification\Term\TermInterface;

interface TermSpecificationInterface
{
    public function getTerm(): TermInterface;
}
