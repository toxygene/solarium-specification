<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\FieldList;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\FieldList
 */
class FieldListTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldsCanBeAdded()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['addField'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('addField')
            ->with($this->equalTo('test'))
            ->will($this->returnSelf());

        $spec = new FieldList('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));    
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldCanBeSet()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['setFields'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('setFields')
            ->with($this->equalTo(['one', 'two']))
            ->will($this->returnSelf());

        $spec = new FieldList(['one', 'two'], FieldList::SET);

        $this->assertSame($spec, $spec->modify($mockQuery));
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     * @expectedException RuntimeException
     */
    public function testAnInvalidModeThrowsAnException()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->createMock(Query::class);

        $spec = new FieldList('test', 'invalid');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
