<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Term\TermInterface;

/**
 * Equality check filter
 */
class Equals implements FilterInterface
{
    /**
     * Field to filter
     *
     * @var string|null
     */
    private $field;
    
    /**
     * Term to search for
     *
     * @var string|TermInterface
     */
    private $term;
    
    /**
     * Constructor
     *
     * @param string|null $field
     * @param string|TermInterface $term
     */
    public function __construct(string $field = null, $term)
    {
        $this->field = $field;
        $this->term = $term;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        if (null !== $this->field) {
            return sprintf(
                '%s:%s',
                $this->field,
                $this->term
            );
        }
        
        return (string) $this->term;
    }
}
