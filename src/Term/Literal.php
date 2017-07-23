<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use SolariumSpecification\TermSpecificationInterface;

class Literal implements TermInterface, TermSpecificationInterface
{
    /**
     * @var string
     */
    private $literal;

    /**
     * Constructor
     *
     * @param string $literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->literal;
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
