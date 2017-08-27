<?php

declare(strict_types=1);

namespace SolariumSpecification;

interface QueryInterface
{
    /**
     * Get the query
     *
     * @return string
     */
    public function getQueryString(): string;
}
