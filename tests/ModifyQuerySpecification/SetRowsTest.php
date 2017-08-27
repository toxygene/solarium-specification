<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\SetRows;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetRows
 */
class SetRowsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetRows()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setRows'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setRows')
            ->with($this->equalTo(10))
            ->will($this->returnSelf());

        $spec = new SetRows(10);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
