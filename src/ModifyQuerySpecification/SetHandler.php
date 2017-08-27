<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

class SetHandler implements ModifyQueryInterface, ModifyQuerySpecificationInterface
{
    /**
     * @var string
     */
    private $handler;

    /**
     * Constructor
     *
     * @param string $handler
     */
    public function __construct(string $handler)
    {
        $this->handler = $handler;
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
        $query->setHandler($this->handler);

        return $this;
    }
}
