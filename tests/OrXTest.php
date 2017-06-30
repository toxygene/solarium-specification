<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\OrX;
use SolariumSpecification\FilterInterface;
use SolariumSpecification\QueryModifierInterface;

/**
 * @coversDefaultClass SolariumSpecification\OrX
 */
class OrXTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::append
     * @covers ::getFilter
     */
    public function testFilterIsBuiltFromChildren()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|FilterInterface $mockFilter1 */
        $mockFilter1 = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockFilter1->expects($this->once())
            ->method('getFilter')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue('a:b'));

        /** @var \PHPUnit_Framework_MockObject_MockObject|FilterInterface $mockFilter2 */
        $mockFilter2 = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockFilter2->expects($this->once())
            ->method('getFilter')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue('c:d'));
    
        $spec = new OrX([$mockFilter1]);
        
        $this->assertSame($spec, $spec->append($mockFilter2));        
        $this->assertEquals('(a:b OR c:d)', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testModifyIsCalledOnChildren()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|QueryModifierInterface $mockQueryModifier1 */
        $mockQueryModifier1 = $this->getMockBuilder(QueryModifierInterface::class)
            ->setMethods(['modify'])
            ->getMock();
        
        $mockQueryModifier1->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        /** @var \PHPUnit_Framework_MockObject_MockObject|QueryModifierInterface $mockQueryModifier2 */
        $mockQueryModifier2 = $this->getMockBuilder(QueryModifierInterface::class)
            ->setMethods(['modify'])
            ->getMock();
        
        $mockQueryModifier2->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        $spec = new OrX([$mockQueryModifier1, $mockQueryModifier2]);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
