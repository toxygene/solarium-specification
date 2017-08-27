<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

/**
 * Set result class query modifier
 */
class SetResultClass implements ModifyQueryInterface, ModifyQuerySpecificationInterface
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
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
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
