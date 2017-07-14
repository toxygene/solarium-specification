<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Excluded;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Excluded
 */
class ExcludedTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testTermsCanBeExcluded()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $mockTerm->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('test'));

        $spec = new Excluded($mockTerm);

        $this->assertEquals('-test', (string) $spec);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $spec = new Excluded($mockTerm);

        $this->assertSame($spec, $spec->getTerm());
    }
}
