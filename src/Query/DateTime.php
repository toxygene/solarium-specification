<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

use DateTimeImmutable;
use DateTimeZone;

class DateTime implements TermInterface
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
}
