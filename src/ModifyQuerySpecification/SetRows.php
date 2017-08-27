<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

/**
 * Set rows query modifier
 */
class SetRows implements ModifyQueryInterface, ModifyQuerySpecificationInterface
{
    /**
     * Rows
     *
     * @var int
     */
    private $rows;
    
    /**
     * Constructor
     *
     * @param int $rows
     */
    public function __construct(int $rows)
    {
        $this->rows = $rows;
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
        $query->setRows($this->rows);
        
        return $this;
    }
}
