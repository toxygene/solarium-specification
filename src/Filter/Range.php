<?php

declare(strict_types=1);

namespace SolariumSpecification\Filter;

use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\Helper;

/**
 * Range filter interface
 */
class Range implements FilterInterface, FilterSpecificationInterface
{
    /**
     * Field to filter against
     *
     * @var string
     */
    private $field;

    /**
     * Start of the range to filter with
     *
     * @var string
     */
    private $start;

    /**
     * End of the range to filter with
     *
     * @var string
     */
    private $end;

    /**
     * Should the start of the range be included
     *
     * @var bool
     */
    private $startInclusive;

    /**
     * Should the end of the range be included
     *
     * @var bool
     */
    private $endInclusive;

    /**
     * Constructor
     *
     * @param string|null $field
     * @param string|null $start
     * @param string|null $end
     * @param bool|null $startInclusive
     * @param bool|null $endInclusive
     */
    public function __construct(
        string $field = null,
        string $start = null,
        string $end = null,
        bool $startInclusive = null,
        bool $endInclusive = null
    )
    {
        if (null === $start) {
            $start = '*';
        }

        if (null === $end) {
            $end = '*';
        }

        if (null === $startInclusive) {
            $startInclusive = true;
        }

        if (null === $endInclusive) {
            $endInclusive = true;
        }

        $this->field = $field;
        $this->start = $start;
        $this->end = $end;
        $this->startInclusive = $startInclusive;
        $this->endInclusive = $endInclusive;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(): string
    {
        $range = Helper::range(
            $this->start,
            $this->end,
            $this->startInclusive,
            $this->endInclusive
        );

        if (null === $this->field) {
            return $range;
        }

        return Helper::equals(
            $this->field,
            $range
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
