<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Group;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Group
 */
class GroupTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testTermsCanBeAppliedToFields()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $mockTerm->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('test'));

        $spec = new Group($mockTerm);

        $this->assertEquals('(test)', (string) $spec);
    }
}
