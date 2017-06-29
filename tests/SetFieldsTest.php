<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\SetFields;

/**
 * @defaultCoversClass SolariumSpecification\SetFields
 */
class SetFieldsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetFields()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setFields'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setFields')
            ->with($this->equalTo(['*', 'b:geodist()']))
            ->will($this->returnSelf());

        $spec = new SetFields(['*', 'b:geodist()']);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
