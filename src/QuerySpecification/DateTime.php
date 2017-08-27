<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification;

use DateTimeImmutable;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\formatDateTimeImmutable;

class DateTime implements QueryInterface, QuerySpecificationInterface
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
    public function getQuery(): QueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return formatDateTimeImmutable($this->dateTime);
    }
}
