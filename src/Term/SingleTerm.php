<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use function SolariumSpecification\escapeTerm;
use SolariumSpecification\TermSpecificationInterface;

class SingleTerm implements TermInterface, TermSpecificationInterface
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
    public function __toString(): string
    {
        return escapeTerm($this->term);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
