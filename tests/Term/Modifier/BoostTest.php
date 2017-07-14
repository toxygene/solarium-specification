<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Boost;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Boost
 */
class BoostTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testTermsCanBeBoosted()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $mockTerm->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('test'));

        $spec = new Boost($mockTerm, 0.5);

        $this->assertEquals('test^0.5', (string) $spec);
    }
}
