<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Term;

use SolariumSpecification\QueryInterface;
use function SolariumSpecification\escapeTerm;

class SingleTerm implements TermSpecificationInterface
{
    /**
     * @var string
     */
    private $term;

    /**
     * Constructor
     *
     * @param string $term;
     */
    public function __construct(string $term)
    {
        $this->term = $term;
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
        return escapeTerm($this->term);
    }
}
