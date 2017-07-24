<?php

declare(strict_types=1);

namespace SolariumSpecification\Term\Modifier;

use function SolariumSpecification\comment;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\Term\SpecificationInterface;

class Comment implements ModifierInterface, SpecificationInterface
{
    /**
     * @var TermInterface
     */
    private $term;

    /**
     * @var string
     */
    private $comment;

    /**
     * Constructor
     *
     * @param TermInterface $term
     * @param string $comment
     */
    public function __construct(TermInterface $term, string $comment)
    {
        $this->term = $term;
        $this->comment = $comment;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return comment((string) $this->term, $this->comment);
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): TermInterface
    {
        return $this;
    }
}
