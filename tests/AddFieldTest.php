<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\AddField;

/**
 * @coversDefaultClass SolariumSpecification\AddField
 */
class AddFieldTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldIsAddedOnModification()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['addField'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('addField')
            ->with($this->equalTo('test'))
            ->will($this->returnSelf());

        $spec = new AddField('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));    
    }
}
