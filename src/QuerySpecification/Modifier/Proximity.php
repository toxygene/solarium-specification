<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Modifier;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Term\Phrase;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\proximity;

class Proximity implements QueryInterface, QuerySpecificationInterface
{
    /**
     * @var Phrase
     */
    private $phrase;

    /**
     * @var int
     */
    private $distance;

    /**
     * Constructor
     *
     * @param Phrase $phrase
     * @param int $distance
     */
    public function __construct(Phrase $phrase, int $distance)
    {
        $this->phrase = $phrase;
        $this->distance = $distance;
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
        return proximity(
            $this->phrase->getQueryString(),
            $this->distance
        );
    }
}
