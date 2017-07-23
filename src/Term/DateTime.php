<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use DateTimeImmutable;
use DateTimeZone;
use SolariumSpecification\TermSpecificationInterface;

class DateTime implements TermInterface, TermSpecificationInterface
{
    /**
     * Date time
     *
     * @var DateTimeImmutable
     */
    private $dateTime;

    /**
     * Constructor
     *
     * @param DateTimeImmutable $dateTime
     */
    public function __construct(DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->dateTime
            ->setTimezone(new DateTimeZone('UTC'))
            ->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
