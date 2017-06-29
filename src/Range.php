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
     * Constructor
     *
     * @param string $field
     * @param string $start
     * @param string $end
     * @param string $startType
     * @param string $endType
     */
    public function __construct(
        string $field,
        string $start, 
        string $end, 
        string $startType = self::LITERAL, 
        string $endType = self::LITERAL
    )
    {
        $this->helper = new Helper();
        $this->field = $field;
        $this->range = $range;
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
        
        return $helper->assemble(
            sprintf(
                '%s:[%s TO %s]',
                '%L1%',
                $startPlaceholder,
                $endPlaceholder
            ),
            [
                $this->field,
                $this->start,
                $this->end
            ]
        );
    }
}
