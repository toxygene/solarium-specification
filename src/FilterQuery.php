<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Filter query query modifier
 */
class FilterQuery implements QueryModifierInterface
{
    /**
     * Name for the filter query
     *
     * @var string
     */
    private $name;
    
    /**
     * Filter to build the query for the filter query
     *
     * @var FilterInterface
     */
    private $filter;
    
    /**
     * Tags for the filter query
     *
     * @var string[]
     */
    private $tags;

    /**
     * Constructor
     *
     * @param string $name
     * @param FilterInterface $filter
     * @param string[] $tags
     */
    public function __construct(string $name, FilterInterface $filter, array $tags = [])
    {
        $this->name = $name;
        $this->filter = $filter;
        $this->tags = $tags;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $filterQuery = $query->createFilterQuery($this->name)
            ->setQuery($this->filter->getFilter($query));
            
        if (!empty($this->tags)) {
            $filterQuery->setTags($this->tags);
        }
        
        return $this;
    }
}
