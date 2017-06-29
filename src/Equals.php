<?php

declare(strict_types=1);

namespace SolariumSpecification;

use RuntimeException;
use Solarium\Core\Query\Helper;
use Solarium\QueryType\Select\Query\Query;

/**
 * Equality check filter
 */
class Equals implements FilterInterface
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
     * Solarium query helper
     *
     * @var Helper
     */
    private $helper;

    /**
     * Field to filter against
     *
     * @var string
     */
    private $field;
    
    /**
     * Value to filter
     *
     * @var string
     */
    private $value;
    
    /**
     * Type of filter
     *
     * @var string
     */
    private $type;
    
    /**
     * Constructor
     *
     * @param string $field
     * @param string $value
     * @param string $type
     */
    public function __construct(string $field, string $value, string $type = self::LITERAL)
    {
        $this->helper = new Helper();
        $this->field = $field;
        $this->value = $value;
        $this->type = $type;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        $parts = [$this->field, $this->value];
        
        switch ($this->type) {
            case self::LITERAL:
                $placeholder = '%L2%';
                break;

            case self::TERM:
                $placeholder = '%T2%';
                break;

            case self::PHRASE:
                $placeholder = '%P2%';
                break;

            default:
                throw new RuntimeException(sprintf('Invalid type "%s"', $this->type));
        }
        
        return $this->helper->assemble(
            sprintf(
                '%%L1%%:%s',
                $placeholder
            ),
            $parts
        );
    }
}
