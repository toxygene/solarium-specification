<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\field;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

class Field implements TermInterface, TermSpecificationInterface
{
    /**
     * Field to apply term to
     *
     * @var string
     */
    private $field;
    
    /**
     * Term
     *
     * @var TermInterface
     */
    private $term;
    
    /**
     * Constructor
     *
     * @param string $field
     * @param TermInterface $term
     */
    public function __construct(string $field, TermInterface $term)
    {
        $this->field = $field;
        $this->term = $term;
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return field(
            $this->field,
            (string) $this->term
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
