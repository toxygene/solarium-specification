<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuery\CompositeModify
 */
class CompositeModifyTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::append
     * @covers ::modify
     */
    public function testModifyIsCalledOnChildren()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|ModifyQueryInterface $mockQueryModifier1 */
        $mockQueryModifier1 = $this->getMockBuilder(ModifyQueryInterface::class)
            ->setMethods(['modify'])
            ->getMock();

        $mockQueryModifier1->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        /** @var \PHPUnit_Framework_MockObject_MockObject|ModifyQueryInterface $mockQueryModifier2 */
        $mockQueryModifier2 = $this->getMockBuilder(ModifyQueryInterface::class)
            ->setMethods(['modify'])
            ->getMock();

        $mockQueryModifier2->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        $spec = new CompositeModify([$mockQueryModifier1]);
        $spec->append($mockQueryModifier2);

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
