<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\AndX;
use SolariumSpecification\Term\TermInterface;

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
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm1 */
        $mockTerm1 = $this->getMockBuilder(TermInterface::class)
            ->getMock();

        $mockTerm1->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('a:b'));

        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm2 */
        $mockTerm2 = $this->getMockBuilder(TermInterface::class)
            ->getMock();

        $mockTerm2->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('c:d'));

        $spec = new AndX([$mockTerm1]);
        $spec->append($mockTerm2);

        $this->assertEquals('(a:b AND c:d)', (string) $spec);
    }
}
