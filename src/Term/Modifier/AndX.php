<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\andX;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\Term\SpecificationInterface;

class AndX implements TermInterface, SpecificationInterface
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
     * @param SpecificationInterface[] $specifications
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
                function(SpecificationInterface $specification) {
                    return (string) $specification->getTerm();
                },
                $this->specifications
            )
        );
    }

    /**
     * Append a term
     *
     * @param SpecificationInterface $specification
     * @return self
     */
    public function append(SpecificationInterface $specification): self
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
