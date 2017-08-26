<?php

namespace SolariumSpecification\Query;

use function SolariumSpecification\field;

class Field implements QueryInterface
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * Constructor
     *
     * @param string $field
     * @param QueryInterface $query
     */
    public function __construct(string $field, QueryInterface $query)
    {
        $this->field = $field;
        $this->query = $query;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return field(
            $this->field,
            $this->query->getQueryString()
        );
    }
}
