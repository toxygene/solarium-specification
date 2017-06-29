<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\AddSort;

/**
 * @coversDefaultClass SolariumSpecification\AddSort
 */
class AddSortTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSortIsAddedOnModification()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['addSort'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('addSort')
            ->with($this->equalTo('test'), $this->equalTo(Query::SORT_ASC))
            ->will($this->returnSelf());

        $spec = new AddSort('test', Query::SORT_ASC);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
