<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use SolariumSpecification\Term\TermInterface;

/**
 * Excluded operator
 */
class Excluded implements ModifierInterface
{
    /**
     * Term
     *
     * @var string|TermInterface
     */
    private $term;

    /**
     * Constructor
     *
     * @param string|TermInterface $term
     */
    public function __construct($term)
    {
        $this->term = $term;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '-%s',
            $this->term
        );
    }
}
