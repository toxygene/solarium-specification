<?php

namespace SolariumSpecification\QuerySpecification\Modifier;

use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Term\SingleTerm;
use SolariumSpecification\QuerySpecificationInterface;
use function SolariumSpecification\fuzzy;

class Fuzzy implements QueryInterface, QuerySpecificationInterface
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
    public function getQuery(): QueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return fuzzy(
            $this->singleTerm->getQueryString(),
            $this->similarity
        );
    }
}
