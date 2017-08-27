<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Solarium\QueryType\Select\Query\Component\FacetSet;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\FacetField;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuery\FacetField
 */
class FacetFieldTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFacetFieldCanBeCreated()
    {
        /** @var Query|PHPUnit_Framework_MockObject_MockObject $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->setMethods(['getFacetSet'])
            ->getMock();

        /** @var FacetSet|PHPUnit_Framework_MockObject_MockObject $mockFacetSet */
        $mockFacetSet = $this->getMockBuilder(FacetSet::class)
            ->setMethods(['createFacetField', 'setContains', 'setContainsIgnoreCase', 'setField', 'setLimit', 'setMethod', 'setMinCount', 'setMissing', 'setOffset', 'setPrefix', 'setSort'])
            ->getMock();

        $mockFacetSet->expects($this->once())
            ->method('createFacetField')
            ->will($this->returnSelf());

        $mockFacetSet->expects($this->once())
            ->method('setContains')
            ->with('contains')
            ->will($this->returnSelf());

        $mockFacetSet->expects($this->once())
            ->method('setContainsIgnoreCase')
            ->with(true)
            ->will($this->returnSelf());

        $mockFacetSet->expects($this->once())
            ->method('setField')
            ->with('field')
            ->will($this->returnSelf());

        $mockQuery->expects($this->once())
            ->method('getFacetSet')
            ->will($this->returnValue($mockFacetSet));

        $modifyQuery = new FacetField(
            'key',
            'field',
            null,
            null,
            null,
            null,
            'contains',
            true
        );

        $modifyQuery->modify($mockQuery);
    }
}
