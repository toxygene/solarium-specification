<?php

namespace SolariumSpecification\Filter;

use SolariumSpecification\FilterSpecificationInterface;

class Literal implements FilterInterface, FilterSpecificationInterface
{
    /**
     * @var string
     */
    private $literal;

    /**
     * Constructor
     *
     * @param string $literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(): string
    {
        return $this->literal;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilter(): FilterInterface
    {
        return $this;
    }
}
