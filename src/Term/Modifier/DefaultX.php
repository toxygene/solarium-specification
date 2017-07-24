<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\defaultX;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\Term\SpecificationInterface;

class DefaultX implements TermInterface, SpecificationInterface
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
        return defaultX(
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
     * @param \SolariumSpecification\Term\SpecificationInterface $specification
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
