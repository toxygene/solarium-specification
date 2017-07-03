<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuery;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuery\Sort;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuery\Sort
 */
class SortTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSortCanBeAdded()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['addSort'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('addSort')
            ->with($this->equalTo('test'), $this->equalTo(Query::SORT_ASC))
            ->will($this->returnSelf());

        $spec = new Sort('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSortCanBeSet()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['clearSorts', 'addSort'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('clearSorts')
            ->will($this->returnSelf());

        $mockQuery->expects($this->once())
            ->method('addSort')
            ->with($this->equalTo('test'), $this->equalTo(Query::SORT_ASC))
            ->will($this->returnSelf());

        $spec = new Sort('test', null, Sort::SET);

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
