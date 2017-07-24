<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\AndX;
use SolariumSpecification\Term\TermSpecificationInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\AndX
 */
class AndXTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::append
     * @covers ::__toString
     */
    public function testTermsCanBeAndedTogether()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermSpecificationInterface $mockTermSpec1 */
        $mockTermSpec1 = $this->getMockBuilder(TermSpecificationInterface::class)
            ->setMethods(['__toString', 'getTerm'])
            ->getMock();

        $mockTermSpec1->expects($this->once())
            ->method('getTerm')
            ->will($this->returnSelf());

        $mockTermSpec1->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('a:b'));

        /** @var \PHPUnit_Framework_MockObject_MockObject|TermSpecificationInterface $mockTermSpec2 */
        $mockTermSpec2 = $this->getMockBuilder(TermSpecificationInterface::class)
            ->setMethods(['__toString', 'getTerm'])
            ->getMock();

        $mockTermSpec2->expects($this->once())
            ->method('getTerm')
            ->will($this->returnSelf());

        $mockTermSpec2->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('c:d'));

        $spec = new AndX([$mockTermSpec1]);
        $spec->append($mockTermSpec2);

        $this->assertEquals('a:b AND c:d', (string) $spec);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        $spec = new AndX();

        $this->assertSame($spec, $spec->getTerm());
    }
}
