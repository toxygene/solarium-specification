<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use function SolariumSpecification\escapePhrase;

class Phrase implements TermInterface
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
}
