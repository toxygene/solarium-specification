<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Abstract specification
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     * Get the specification
     *
     * @return SpecificationInterface
     */
    abstract public function getSpec(): SpecificationInterface;

    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        return $this->getSpec()->getFilter($query);
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        return $this->getSpec()->modify($query);
    }
}
