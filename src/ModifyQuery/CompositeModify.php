<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;

class CompositeModify implements ModifyQueryInterface, SpecificationInterface
{
    /**
     * @var ModifyQueryInterface[]
     */
    private $modifiers;

    /**
     * Constructor
     *
     * @param ModifyQueryInterface[] $modifiers
     */
    public function __construct(array $modifiers = [])
    {
        $this->modifiers = $modifiers;
    }

    /**
     * Append a modifier
     *
     * @param ModifyQueryInterface $modifier
     * @return $this
     */
    public function append(ModifyQueryInterface $modifier)
    {
        $this->modifiers[] = $modifier;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        foreach ($this->modifiers as $modifier) {
            $modifier->getModifyQuery()
                ->modify($query);
        }

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
