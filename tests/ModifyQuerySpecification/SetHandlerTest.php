<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\SetHandler;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuery\SetResultClass
 */
class SetHandlerTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testHandlerCanBeSet()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setHandler'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setHandler')
            ->with($this->equalTo('test'))
            ->will($this->returnSelf());

        $spec = new SetHandler('test');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
