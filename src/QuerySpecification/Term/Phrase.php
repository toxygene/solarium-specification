<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Term;

use SolariumSpecification\QueryInterface;
use function SolariumSpecification\escapePhrase;

class Phrase implements TermSpecificationInterface
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
    public function getQuery(): QueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return escapePhrase($this->phrase);
    }
}
