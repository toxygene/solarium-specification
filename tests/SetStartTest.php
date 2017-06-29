<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\SetStart;

/**
 * @defaultCoversClass SolariumSpecification\SetStart
 */
class SetStartTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetStart()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setStart'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setStart')
            ->with($this->equalTo(10))
            ->will($this->returnSelf());

        $spec = new SetStart(10);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
