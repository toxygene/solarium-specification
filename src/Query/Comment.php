<?php

declare(strict_types=1);

namespace SolariumSpecification\Query;

use function SolariumSpecification\comment;

class Comment implements QueryInterface
{
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var string
     */
    private $comment;

    /**
     * Constructor
     *
     * @param QueryInterface $query
     * @param string $comment
     */
    public function __construct(QueryInterface $query, string $comment)
    {
        $this->query = $query;
        $this->comment = $comment;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString(): string
    {
        return comment(
            $this->query
                ->getQueryString(),
            $this->comment
        );
    }
}
