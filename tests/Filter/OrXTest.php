<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Filter;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Filter\FilterInterface;
use SolariumSpecification\Filter\OrX;

/**
 * @coversDefaultClass \SolariumSpecification\Filter\OrX
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
        /** @var \PHPUnit_Framework_MockObject_MockObject|FilterInterface $mockFilter1 */
        $mockFilter1 = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockFilter1->expects($this->once())
            ->method('getFilter')
            ->will($this->returnValue('a:b'));

        /** @var \PHPUnit_Framework_MockObject_MockObject|FilterInterface $mockFilter2 */
        $mockFilter2 = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockFilter2->expects($this->once())
            ->method('getFilter')
            ->will($this->returnValue('c:d'));
    
        $spec = new OrX([$mockFilter1]);
        
        $this->assertSame($spec, $spec->append($mockFilter2));        
        $this->assertEquals('(a:b OR c:d)', $spec->filter());
    }
}
