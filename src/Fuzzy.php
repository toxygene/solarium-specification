<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

class Fuzzy implements FilterInterface
{
    /**
     * Constructor
     *
     * @param string $field
     * @param int $distance
     */
    public function __construct(string $field, int $distance = null)
    {
        $this->field = $field;
        $this->distance = $distance;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        if (null === $this->distance) {
            return sprintf(
                '%s~',
                $this->field
            );
        }
        
        return sprintf(
            '%s~%d',
            $this->field,
            $this->distance
        );
    }
}
