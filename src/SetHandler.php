<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

class SetHandler implements QueryModifierInterface
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
    public function modify(Query $query): QueryModifierInterface
    {
        $query->setHandler($this->handler);

        return $this;
    }
}
