<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Range;

/**
 * @coversDefaultClass \SolariumSpecification\Range
 */
class RangeTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeWithLiterals()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->createMock(Query::class);
    
        $spec = new Range(
            'a',
            null,
            '100'
        );
        
        $this->assertEquals('a:[* TO 100]', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeStartAndEndExcluded()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->createMock(Query::class);
    
        $spec = new Range(
            'a',
            null,
            null,
            false,
            false
        );
        
        $this->assertEquals('a:{* TO *}', $spec->getFilter($mockQuery));
    }
}
