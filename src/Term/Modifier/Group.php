<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use SolariumSpecification\Term\TermInterface;

/**
 * Group a term
 */
class Group implements ModifierInterface
{
    /**
     * Term to group
     *
     * @var string|TermInterface
     */
    private $term;

    /**
     * Constructor
     *
     * @param string|TermInterface $terms
     */
    public function __construct($term)
    {
        $this->term = $term;
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf(
            '(%s)',
            $this->term
        );
    }
}
