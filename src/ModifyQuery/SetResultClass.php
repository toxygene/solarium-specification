<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;

/**
 * Set result class query modifier
 */
class SetResultClass implements ModifyQueryInterface
{
    /**
     * Result class
     *
     * @var string
     */
    private $resultClass;
    
    /**
     * Constructor
     *
     * @param string $resultClass
     */
    public function __construct(string $resultClass)
    {
        $this->resultClass = $resultClass;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->setResultClass($this->resultClass);
        
        return $this;
    }
}
