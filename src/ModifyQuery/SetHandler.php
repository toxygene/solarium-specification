<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use Solarium\QueryType\Select\Query\Query;

class SetHandler implements ModifyQueryInterface
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
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->setHandler($this->handler);

        return $this;
    }
}
