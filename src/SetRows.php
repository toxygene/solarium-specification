<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Set rows query modifier
 */
class SetRows implements QueryModifierInterface
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
    public function modify(Query $query): QueryModifierInterface
    {
        $query->setRows($this->rows);
        
        return $this;
    }
}
