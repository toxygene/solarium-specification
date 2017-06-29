<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;

/**
 * Add field query modifier
 */
class AddField implements QueryModifierInterface
{
    /**
     * Field to add
     *
     * @var string
     */
    private $field;

    /**
     * Constructor
     *
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $query->addField($this->field);
        
        return $this;
    }
}
