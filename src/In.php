<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\Core\Query\Helper;
use Solarium\QueryType\Select\Query\Query;

/**
 * In filter
 */
class In implements FilterInterface
{
    /**
     * Literal placeholder type
     *
     * @var string
     */
    const LITERAL = 'literal';
    
    /**
     * Term placeholder type
     *
     * @var string
     */
    const TERM = 'term';
    
    /**
     * Phrase placeholder type
     *
     * @var string
     */
    const PHRASE = 'phrase';
    
    /**
     * Field
     *
     * @var string
     */
    private $field;
    
    /**
     * Helper
     *
     * @var Helper
     */
    private $helper;
    
    /**
     * Value types
     *
     * @var string[]
     */
    private $types;

    /**
     * Values
     *
     * @var string[]
     */
    private $values;
    
    /**
     * Constructor
     *
     * @param string $field
     * @param string[] $values
     */
    public function __construct(string $field, array $values, array $types)
    {
        $this->helper = new Helper();
        $this->field = $field;
        $this->values = $values;
        $this->types = $types;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        $placeholders = [];
        $parts = [$this->field];
        
        foreach ($this->values as $key => $value) {
            switch ($this->types[$key] ?? self::LITERAL) {
                case self::LITERAL:
                    $placeholders[] = sprintf('%%L%s%%', $key + 2);
                    break;

                case self::TERM:
                    $placeholders[] = sprintf('%%T%s%%', $key + 2);
                    break;

                case self::PHRASE:
                    $placeholders[] = sprintf('%%P%s%%', $key + 2);
                    break;

                default:
                    throw new RuntimeException(sprintf('Invalid type "%s"', $this->type));
            }
            
            $parts[] = $value;
        }
        
        return $this->helper->assemble(
            sprintf(
                '%%L1%%:(%s)',
                implode(
                    ' OR ',
                    $placeholders
                )
            ),
            $parts
        );
    }
}
