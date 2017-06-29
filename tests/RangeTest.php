<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Range;

/**
 * @defaultCoversClass SolariumSpecification\Range
 */
class RangeTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeWithLiterals()
    {
        $mockQuery = $this->createMock(Query::class);
    
        $spec = new Range(
            'a',
            '*',
            '100'
        );
        
        $this->assertEquals('a:[* TO 100]', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeWithTerms()
    {
        $mockQuery = $this->createMock(Query::class);
    
        $spec = new Range(
            'a',
            't*a',
            'a*t',
            Range::TERM,
            Range::TERM
        );
        
        $this->assertEquals('a:[t\*a TO a\*t]', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeWithPhrases()
    {
        $mockQuery = $this->createMock(Query::class);
    
        $spec = new Range(
            'a',
            't*a',
            'a*t',
            Range::PHRASE,
            Range::PHRASE
        );
        
        $this->assertEquals('a:["t*a" TO "a*t"]', $spec->getFilter($mockQuery));
    }
}
