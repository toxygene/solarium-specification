<?php

namespace SolariumSpecification\Filter;

interface FilterInterface
{
    /**
     * Get the filter
     *
     * @return string
     */
    public function filter(): string;
}
