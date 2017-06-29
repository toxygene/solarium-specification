<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\SetResultClass;

/**
 * @defaultCoversClass SolariumSpecification\SetResultClass
 */
class SetResultClassTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetResultClass()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setResultClass'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setResultClass')
            ->with($this->equalTo('test'))
            ->will($this->returnSelf());

        $spec = new SetResultClass('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
