<?php

declare(strict_types=1);

namespace SolariumSpecification\Filter;

use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\Helper;

/**
 * And X filter
 */
class AndX implements FilterInterface, FilterSpecificationInterface
{
    /**
     * Children
     *
     * @var FilterSpecificationInterface[]
     */
    private $filterSpecifications;

    /**
     * Constructor
     *
     * @param FilterSpecificationInterface[] $filterSpecifications
     */
    public function __construct(array $filterSpecifications = [])
    {
        $this->filterSpecifications = $filterSpecifications;
    }

    /**
     * Append a child
     *
     * @param FilterSpecificationInterface $filterSpecification
     * @return self
     */
    public function append(FilterSpecificationInterface $filterSpecification): self
    {
        $this->filterSpecifications[] = $filterSpecification;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(): string
    {
        return Helper::andX(
            array_map(
                function(FilterSpecificationInterface $filterSpecification) {
                    return $filterSpecification->getFilter()
                        ->filter();
                },
                $this->filterSpecifications
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
