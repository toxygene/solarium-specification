<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

class SingleTerm implements TermInterface
{
    /**
     * Term
     *
     * @var string
     */
    private $term;

    /**
     * Constructor
     *
     * @param string $term
     */
    public function __construct(string $term)
    {
        $this->term = $term;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $pattern = '/(\+|-|&&|\|\||!|\(|\)|\{|}|\[|]|\^|"|~|\*|\?|:|\/|\\\)/';

        return preg_replace($pattern, '\\\$1', $this->term);
    }
}
