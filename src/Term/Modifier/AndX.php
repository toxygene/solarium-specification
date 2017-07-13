<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\andX;
use SolariumSpecification;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class AndX implements TermInterface, TermSpecificationInterface
{
    /**
     * Children
     *
     * @var TermInterface[]
     */
    private $terms;

    /**
     * Constructor
     *
     * @param TermInterface[] $terms
     */
    public function __construct(array $terms = [])
    {
        $this->terms = $terms;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return andX($this->terms);
    }

    /**
     * Append a term
     *
     * @param TermInterface $term
     * @return self
     */
    public function append(TermInterface $term): self
    {
        $this->terms[] = $term;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
