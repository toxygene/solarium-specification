<?php

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

class Composite implements ModifyQueryInterface, ModifyQuerySpecificationInterface
{
    /**
     * @var ModifyQuerySpecificationInterface[]
     */
    private $modifyQuerySpecifications;

    /**
     * Constructor
     *
     * @param ModifyQuerySpecificationInterface[] $modifyQuerySpecifications
     */
    public function __construct($modifyQuerySpecifications = [])
    {
        $this->modifyQuerySpecifications = $modifyQuerySpecifications;
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
        foreach ($this->modifyQuerySpecifications as $modifyQuerySpecification) {
            $modifyQuerySpecification->getModifyQuery()
                ->modify($query);
        }

        return $this;
    }
}
