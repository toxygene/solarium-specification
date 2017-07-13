<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use function SolariumSpecification\range;
use SolariumSpecification\TermSpecificationInterface;

class Range implements TermInterface, TermSpecificationInterface
{
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
     * @param string|null $start
     * @param string|null $end
     * @param bool|null $startInclusive
     * @param bool|null $endInclusive
     */
    public function __construct(
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

        $this->start = $start;
        $this->end = $end;
        $this->startInclusive = $startInclusive;
        $this->endInclusive = $endInclusive;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return range(
            $this->start,
            $this->end,
            $this->startInclusive,
            $this->endInclusive
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}