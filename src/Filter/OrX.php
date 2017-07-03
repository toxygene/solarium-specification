<?php

declare(strict_types=1);

namespace SolariumSpecification\Filter;

use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\Helper;

/**
 * Or X filter
 */
class OrX implements FilterInterface, FilterSpecificationInterface
{
    /**
     * Children
     *
     * @var FilterInterface[]
     */
    private $filters;

    /**
     * Constructor
     *
     * @param FilterInterface[] $filters
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Append a child
     *
     * @param FilterInterface $filter
     * @return self
     */
    public function append(FilterInterface $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(): string
    {
        return Helper::orX(
            array_map(
                function(FilterInterface $filter) {
                    return $filter->filter();
                },
                $this->filters
            )
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
