<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term\Modifier;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Modifier\Comment;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Modifier\Comment
 */
class CommentTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testCommentsCanBeAppliedToTerms()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $mockTerm->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('test'));

        $spec = new Comment($mockTerm, 'test');

        $this->assertEquals('test /* test */', (string) $spec);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|TermInterface $mockTerm */
        $mockTerm = $this->createMock(TermInterface::class);

        $spec = new Comment($mockTerm, 'comment');

        $this->assertSame($spec, $spec->getTerm());
    }
}
