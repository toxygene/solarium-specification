<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

use DateTimeImmutable;
use DateTimeZone;
use function SolariumSpecification\formatDateTimeImmutable;

class DateTime implements QueryInterface
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
    public function getQueryString(): string
    {
        return formatDateTimeImmutable($this->dateTime);
    }
}
