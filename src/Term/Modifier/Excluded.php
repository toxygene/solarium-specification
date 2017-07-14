<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class Excluded implements ModifierInterface, TermSpecificationInterface
{
    /**
     * @var TermInterface
     */
    private $term;

    /**
     * Constructor
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
        return sprintf(
            '-%s',
            $this->term
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
