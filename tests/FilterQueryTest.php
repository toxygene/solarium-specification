<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\FilterQuery as SolariumFilterQuery;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\FilterInterface;
use SolariumSpecification\FilterQuery;

/**
 * @defaultCoversClass SolariumSpecification\FilterQuery
 */
class FilterQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFilterQueryIsAdded()
    {
        // Solarium FilterQuery created by the specification filter query class

        /** @var \PHPUnit_Framework_MockObject_MockObject|SolariumFilterQuery $mockSolariumFilterQuery */
        $mockSolariumFilterQuery = $this->getMockBuilder(SolariumFilterQuery::class)
            ->setMethods(['setQuery', 'setTags'])
            ->getMock();
            
        $mockSolariumFilterQuery->expects($this->once())
            ->method('setQuery')
            ->with($this->equalTo('a:b'))
            ->will($this->returnSelf());

        $mockSolariumFilterQuery->expects($this->once())
            ->method('setTags')
            ->with($this->equalTo(['tag1', 'tag2']))
            ->will($this->returnSelf());

        // Solarium Query the specification is applied to

        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->setMethods(['createFilterQuery'])
            ->getMock();

        $mockQuery->expects($this->once())
            ->method('createFilterQuery')
            ->with($this->equalTo('name'))
            ->will($this->returnValue($mockSolariumFilterQuery));

        // Mock specification filter to run

        /** @var \PHPUnit_Framework_MockObject_MockObject|FilterInterface $mockFilter */
        $mockFilter = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockFilter->expects($this->once())
            ->method('getFilter')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue('a:b'));

        $spec = new FilterQuery('name', $mockFilter, ['tag1', 'tag2']);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
