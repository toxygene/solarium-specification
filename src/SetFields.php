<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Set fields query modifier
 */
class SetFields implements QueryModifier
{
    /**
     * Fields to set
     *
     * @var string[]
     */
    private $fields;

    /**
     * Constructor
     *
     * @param string[] $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $query->setFields($this->fields);
        
        return $this;
    }
}
