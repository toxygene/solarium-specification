<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use function SolariumSpecification\escapePhrase;
use SolariumSpecification\TermSpecificationInterface;

class Phrase implements TermInterface, TermSpecificationInterface
{
    /**
     * @var string
     */
    private $phrase;

    /**
     * Constructor
     *
     * @param string $phrase
     */
    public function __construct(string $phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return escapePhrase($this->phrase);
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
