<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Or X filter
 */
class OrX implements FilterInterface, QueryModifierInterface
{
    /**
     * Constructor
     *
     * @param array $children
     */
    public function __construct(array $children = [])
    {
        $this->children = $children;
    }
    
    /**
     * Append a child
     *
     * @param FilterIterator|QueryModifierInterface $child
     * @return self
     */
    public function append($child): self
    {
        $this->children[] = $child;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        return sprintf(
            '(%s)',
            implode(
                ' OR ',
                array_filter(array_map(
                    function($child) use ($query) {
                        if ($child instanceof FilterInterface) {
                            return $child->getFilter($query);
                        }
                    },
                    $this->children
                ))
            )
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        foreach ($this->children as $child) {
            if ($child instanceof QueryModifierInterface) {
                $child->modify($query);
            }
        }

        return $this;
    }
}
