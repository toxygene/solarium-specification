<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

class AddParam implements QueryModifierInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $query->addParam($this->name, $this->value);

        return $this;
    }
}
