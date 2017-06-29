<?php

declare(strict_types=1);

namespace SolariumSpecification;

use FilterIterator;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Term\Modifier\Group;

/**
 * And X filter
 */
class AndX implements FilterInterface, QueryModifierInterface
{
    /**
     * Children
     *
     * @var array
     */
    private $children;

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
        $terms = implode(
            ' AND ',
            array_filter(array_map(
                function($child) use ($query) {
                    if ($child instanceof FilterInterface) {
                        return $child->getFilter($query);
                    }

                    return null;
                },
                $this->children
            ))
        );
        
        return (string) new Group($terms);
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
