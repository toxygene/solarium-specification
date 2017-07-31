<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Query\FilterQuery as QueryFilterQuery;
use SolariumSpecification\Query\QueryInterface;

/**
 * Filter query query modifier
 */
class FilterQuery implements ModifyQueryInterface
{
    /**
     * Add mode
     *
     * @var string
     */
    const ADD = 'add';

    /**
     * Replace mode
     *
     * @var string
     */
    const REPLACE = 'replace';

    /**
     * Update mode
     *
     * @var string
     */
    const UPDATE = 'update';

    /**
     * Name for the filter query
     *
     * @var string
     */
    private $key;
    
    /**
     * Term specification to use for the filter query
     *
     * @var QueryInterface
     */
    private $query;

    /**
     * Mode
     *
     * @var string
     */
    private $mode;
    
    /**
     * Tags for the filter query
     *
     * @var string[]|null
     */
    private $tags;

    /**
     * Constructor
     *
     * @param string $key
     * @param QueryInterface $query
     * @param string[] $tags
     * @param string|null $mode
     */
    public function __construct(
        string $key,
        QueryInterface $query,
        array $tags = null,
        string $mode = null
    )
    {
        if (null === $mode) {
            $mode = self::ADD;
        }

        $this->key = $key;
        $this->query = $query;
        $this->tags = $tags;
        $this->mode = $mode;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        $filterQuery = $this->buildFilterQuery($query)
            ->setQuery((string) $this->query->getString());

        // todo add support for modifying filter queries?

        if (null !== $this->tags) {
            $filterQuery->setTags($this->tags);
        }
        
        return $this;
    }

    /**
     * Build the filter query
     *
     * @param Query $query
     * @return QueryFilterQuery
     */
    private function buildFilterQuery(Query $query): QueryFilterQuery
    {
        switch ($this->mode) {
            case self::ADD:
                return $query->createFilterQuery($this->key);

            case self::REPLACE:
                $query->removeFilterQuery($this->key);

                return $query->createFilterQuery($this->key);

            case self::UPDATE:
                return $query->getFilterQuery($this->key);

            default:
                throw new RuntimeException(sprintf('Unknown mode "%s"', $this->mode));
        }
    }
}
