<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\boost;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class Boost implements ModifierInterface, TermSpecificationInterface
{
    /**
     * @var float|null
     */
    private $amount;
    
    /**
     * @var TermInterface
     */
    private $term;
    
    /**
     * Constructor
     *
     * @param TermInterface $term
     * @param float|null $amount
     */
    public function __construct(TermInterface $term, float $amount = null)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return boost(
            (string) $this->term,
            $this->amount
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
