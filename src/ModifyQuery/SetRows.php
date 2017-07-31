<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;

/**
 * Set rows query modifier
 */
class SetRows implements ModifyQueryInterface
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
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->setRows($this->rows);
        
        return $this;
    }
}
