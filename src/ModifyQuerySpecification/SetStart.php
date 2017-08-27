<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
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
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->setStart($this->start);
        
        return $this;
    }
}
