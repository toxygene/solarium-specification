<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Add sort query modifier
 */
class AddSort implements QueryModifierInterface
{
    /**
     * Sort by
     *
     * @var string
     */
    private $sortBy;
    
    /**
     * Sort direction
     *
     * @var string
     */
    private $direction;
    
    /**
     * Constructor
     * 
     * @param string $sortBy
     * @param string $direction
     */
    public function __construct(string $sortBy, string $direction)
    {
        $this->sortBy = $sortBy;
        $this->direction = $direction;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $query->addSort($this->sortBy, $this->direction);

        return $this;
    }
}
