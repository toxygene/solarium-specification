<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\SetRows;

/**
 * @defaultCoversClass SolariumSpecification\SetRows
 */
class SetRowsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetRows()
    {
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
