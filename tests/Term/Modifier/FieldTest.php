<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Field;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Field
 */
class FieldTest extends TestCase
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

        $spec = new Field('field', $mockTerm);

        $this->assertEquals('field:test', (string) $spec);
    }
}
