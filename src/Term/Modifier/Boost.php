<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use SolariumSpecification\Term\TermInterface;

/**
 * Boosts a search term
 */
class Boost implements ModifierInterface
{
    /**
     * Amount to boost by
     *
     * @var float
     */
    private $amount;
    
    /**
     * Term to boost
     *
     * @var string|TermInterface
     */
    private $term;
    
    /**
     * Constructor
     *
     * @param string|TermInterface $term
     * @param float $amount
     */
    public function __construct($term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s^%d',
            $this->term,
            $this->amount
        );
    }
}
