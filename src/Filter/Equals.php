<?php

declare(strict_types=1);

namespace SolariumSpecification\Filter;

use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\Helper;

/**
 * Equality check filter
 */
class Equals implements FilterInterface, FilterSpecificationInterface
{
    /**
     * Field to filter
     *
     * @var string|null
     */
    private $field;
    
    /**
     * Term to search for
     *
     * @var string
     */
    private $term;
    
    /**
     * Constructor
     *
     * @param string|null $field
     * @param string $term
     */
    public function __construct(string $field = null, string $term)
    {
        $this->field = $field;
        $this->term = $term;
    }
    
    /**
     * {@inheritdoc}
     */
    public function filter(): string
    {
        if (null === $this->field) {
            return $this->term;
        }

        return Helper::equals(
            $this->field,
            $this->term
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilter(): FilterInterface
    {
        return $this;
    }
}
