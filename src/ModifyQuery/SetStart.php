<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecificationInterface;

/**
 * Set start query modifier
 */
class SetStart implements ModifyQueryInterface, ModifyQuerySpecificationInterface
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
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->setStart($this->start);
        
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
    }
}
