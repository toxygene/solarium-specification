<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\SetStart;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetStart
 */
class SetStartTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetStart()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
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
