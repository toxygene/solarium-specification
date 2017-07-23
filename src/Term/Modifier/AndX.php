<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\andX;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class AndX implements TermInterface, TermSpecificationInterface
{
    /**
     * Children
     *
     * @var TermInterface[]
     */
    private $specifications;

    /**
     * Constructor
     *
     * @param TermSpecificationInterface[] $specifications
     */
    public function __construct(array $specifications = [])
    {
        $this->specifications = $specifications;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return andX(
            array_map(
                function(TermSpecificationInterface $specification) {
                    return (string) $specification->getTerm();
                },
                $this->specifications
            )
        );
    }

    /**
     * Append a term
     *
     * @param TermSpecificationInterface $specification
     * @return self
     */
    public function append(TermSpecificationInterface $specification): self
    {
        $this->specifications[] = $specification;

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
