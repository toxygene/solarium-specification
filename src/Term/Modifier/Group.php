<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\group;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class Group implements ModifierInterface, TermSpecificationInterface
{
    /**
     * @var TermInterface
     */
    private $term;

    /**
     * Constructor
     *
     * @param TermInterface $term
     */
    public function __construct(TermInterface $term)
    {
        $this->term = $term;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return group($this->term);
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
