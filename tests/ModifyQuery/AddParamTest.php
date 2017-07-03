<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuery;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuery\AddParam;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuery\AddParam
 */
class AddParamTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testParameterIsAddedToTheQuery()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['addParam'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('addParam')
            ->with($this->equalTo('name'), $this->equalTo('value'))
            ->will($this->returnSelf());

        $spec = new AddParam('name', 'value');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
