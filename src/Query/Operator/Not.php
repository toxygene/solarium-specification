<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Operator;

use function SolariumSpecification\not;
use SolariumSpecification\Query\QueryInterface;

class Not implements QueryInterface
{
    /**
     * @var QueryInterface
     */
    private $contains;

    /**
     * @var QueryInterface
     */
    private $excludes;

    /**
     * Constructor
     *
     * @param QueryInterface $contains
     * @param QueryInterface $excludes
     */
    public function __construct(
        QueryInterface $contains,
        QueryInterface $excludes
    )
    {
        $this->contains = $contains;
        $this->excludes = $excludes;
    }

    /**
     * {@inheritdoc}
     */
    public function getString(): string
    {
        return not(
            $this->contains->getString(),
            $this->excludes->getString()
        );
    }
}
