<?php

namespace SolariumSpecification\Query\Modifiers;

use function SolariumSpecification\fuzzy;
use SolariumSpecification\Query\QueryInterface;
use SolariumSpecification\Query\Term\SingleTerm;

class Fuzzy implements QueryInterface
{
    /**
     * @var SingleTerm
     */
    private $singleTerm;

    /**
     * @var float|null
     */
    private $similarity;

    /**
     * Constructor
     *
     * @param SingleTerm $singleTerm
     * @param float|null $similarity
     */
    public function __construct(SingleTerm $singleTerm, float $similarity = null)
    {
        $this->singleTerm = $singleTerm;
        $this->similarity = $similarity;
    }

    /**
     * {@inheritdoc}
     */
    public function getString(): string
    {
        return fuzzy(
            $this->singleTerm->getString(),
            $this->similarity
        );
    }
}
