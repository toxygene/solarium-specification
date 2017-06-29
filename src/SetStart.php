<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Set start query modifier
 */
class SetStart implements QueryModifierInterface
{
    /**
     * Start
     *
     * @var int
     */
    private $start;
    
    /**
     * Constructor
     *
     * @param int $start
     */
    public function __construct(int $start)
    {
        $this->start = $start;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $query->setStart($this->start);
        
        return $this;
    }
}
