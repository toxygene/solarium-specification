<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

class AddParam implements ModifyQueryInterface, ModifyQuerySpecificationInterface
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
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        $query->addParam($this->name, $this->value);

        return $this;
    }
}
