<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use function SolariumSpecification\range;

class Range implements TermInterface, SpecificationInterface
{
    /**
     * Start of the range to filter with
     *
     * @var TermInterface
     */
    private $start;

    /**
     * End of the range to filter with
     *
     * @var TermInterface
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
     * @param TermInterface|null $start
     * @param TermInterface|null $end
     * @param bool|null $startInclusive
     * @param bool|null $endInclusive
     */
    public function __construct(
        TermInterface $start = null,
        TermInterface $end = null,
        bool $startInclusive = null,
        bool $endInclusive = null
    )
    {
        if (null === $start) {
            $start = new Literal('*');
        }

        if (null === $end) {
            $end = new Literal('*');
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
            (string) $this->start,
            (string) $this->end,
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
