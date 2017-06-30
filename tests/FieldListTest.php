<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\FieldList;

/**
 * @coversDefaultClass SolariumSpecification\FieldList
 */
class FieldListTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldIsAddedOnModification()
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
}