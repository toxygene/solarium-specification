<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

class Phrase implements TermInterface
{
    /**
     * Phrase
     *
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
    public function __toString()
    {
        return '"' . preg_replace('/("|\\\)/', '\\\$1', $this->phrase) . '"';
    }
}
