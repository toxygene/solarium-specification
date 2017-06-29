<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\Core\Query\Helper;
use Solarium\QueryType\Select\Query\Query;

/**
 * Range filter interface
 */
class Range implements FilterInterface
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
     * Helper
     *
     * @var string
     */
    private $helper;
    
    /**
     * Field to filter against
     *
     * @var string
     */
    private $field;
    
    /**
     * Start of the range to filter with
     *
     * @var string
     */
    private $start;
    
    /**
     * End of the range to filter with
     *
     * @var string
     */
    private $end;
    
    /**
     * Type of placeholder for the start
     *
     * @var string
     */
    private $startType;
    
    /**
     * Type of placeholder for the end
     *
     * @var string
     */
    private $endType;
    
    /**
     * Should the start of the range be included
     *
     * @var bool
     */
    private $startInclusive;
    
    /**
     * Should the end of the range be included
     *
     * @var bool
     */
    private $endInclusive;
    
    /**
     * Constructor
     *
     * @param string $field
     * @param string $start
     * @param string $end
     * @param string $startType
     * @param string $endType
     * @param bool $startInclusive
     * @param bool $endInclusive
     */
    public function __construct(
        string $field,
        string $start = '*', 
        string $end = '*', 
        string $startType = self::LITERAL, 
        string $endType = self::LITERAL,
        bool $startInclusive = true,
        bool $endInclusive = true
    )
    {
        $this->helper = new Helper();
        $this->field = $field;
        $this->start = $start;
        $this->end = $end;
        $this->startType = $startType;
        $this->endType = $endType;
        $this->startInclusive = $startInclusive;
        $this->endInclusive = $endInclusive;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        switch ($this->startType) {
            case self::LITERAL:
                $startPlaceholder = '%L2%';
                break;

            case self::TERM:
                $startPlaceholder = '%T2%';
                break;

            case self::PHRASE:
                $startPlaceholder = '%P2%';
                break;

            default:
                throw new RuntimeException(sprintf('Invalid start type "%s"', $this->startType));
        }
        
        switch ($this->endType) {
            case self::LITERAL:
                $endPlaceholder = '%L3%';
                break;

            case self::TERM:
                $endPlaceholder = '%T3%';
                break;

            case self::PHRASE:
                $endPlaceholder = '%P3%';
                break;

            default:
                throw new RuntimeException(sprintf('Invalid end type "%s"', $this->endType));
        }
        
        return $this->helper->assemble(
            sprintf(
                '%%L1%%:%s%s TO %s%s',
                $this->startInclusive ? '[' : '{',
                $startPlaceholder,
                $endPlaceholder,
                $this->endInclusive ? ']' : '}'
            ),
            [
                $this->field,
                $this->start,
                $this->end
            ]
        );
    }
}
