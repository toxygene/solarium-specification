<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

interface QueryInterface
{
    /**
     * Get the query
     *
     * @return string
     */
    public function getString(): string;
}
