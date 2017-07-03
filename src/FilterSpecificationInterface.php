<?php

namespace SolariumSpecification;

use SolariumSpecification\Filter\FilterInterface;

interface FilterSpecificationInterface
{
    public function getFilter(): FilterInterface;
}
