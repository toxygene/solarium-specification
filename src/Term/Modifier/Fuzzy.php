<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use SolariumSpecification\Term\TermInterface;

/**
 * Fuzzy search modifier
 */
class Fuzzy implements ModifierInterface
{
    /**
     * Distance to search
     *
     * @var int
     */
    private $distance;
    
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
     * @param int $distance
     */
    public function __construct($term, int $distance)
    {
        $this->term = $term;
        $this->distance = $distance;
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        if (null !== $this->distance) {
            return sprintf(
                '%s~%d',
                $this->term,
                $this->distance
            );
        }
        
        return sprintf(
            '%s~',
            $this->term
        );
    }
}
