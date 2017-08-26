<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Modifiers;

use function SolariumSpecification\proximity;
use SolariumSpecification\Query\QueryInterface;
use SolariumSpecification\Query\Term\Phrase;

class Proximity implements QueryInterface
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
    public function getQueryString(): string
    {
        return proximity(
            $this->phrase->getQueryString(),
            $this->distance
        );
    }
}
