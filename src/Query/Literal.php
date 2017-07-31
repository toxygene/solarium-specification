<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

class Literal implements QueryInterface
{
    /**
     * @var string
     */
    private $literal;

    /**
     * Constructor
     *
     * @param string $literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
    }

    /**
     * {@inheritdoc}
     */
    public function getString(): string
    {
        return $this->literal;
    }
}
