<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Term\TermInterface;

/**
 * Range filter interface
 */
class Range implements FilterInterface
{
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
     * @param string|null $field
     * @param string|TermInterface|null $start
     * @param string|TermInterface|null $end
     * @param bool|null $startInclusive
     * @param bool|null $endInclusive
     */
    public function __construct(
        string $field = null,
        $start = null, 
        $end = null,
        bool $startInclusive = null,
        bool $endInclusive = null
    )
    {
        if (null === $start) {
            $start = '*';
        }
        
        if (null === $end) {
            $end = '*';
        }
        
        if (null === $startInclusive) {
            $startInclusive = true;
        }
        
        if (null === $endInclusive) {
            $endInclusive = true;
        }
    
        $this->field = $field;
        $this->start = $start;
        $this->end = $end;
        $this->startInclusive = $startInclusive;
        $this->endInclusive = $endInclusive;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilter(Query $query): string
    {
        $range = sprintf(
            '%s%s TO %s%s',
            $this->startInclusive ? '[' : '{',
            $this->start,
            $this->end,
            $this->endInclusive ? ']' : '}'
        );
        
        if (null !== $this->field) {
            return sprintf(
                '%s:%s',
                $this->field,
                $range
            );
        }
        
        return $range;
    }
}
