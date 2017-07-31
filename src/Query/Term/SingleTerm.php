<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Term;

use function SolariumSpecification\escapeTerm;

class SingleTerm implements TermInterface
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
    public function getString(): string
    {
        return escapeTerm($this->term);
    }
}
