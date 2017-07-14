<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Required;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Required
 */
class RequiredTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testTermsCanBeRequired()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $mockTerm->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('test'));

        $spec = new Required($mockTerm);

        $this->assertEquals('+test', (string) $spec);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $spec = new Required($mockTerm);

        $this->assertSame($spec, $spec->getTerm());
    }
}
