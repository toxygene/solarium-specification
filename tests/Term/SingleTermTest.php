<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Single;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Single
 */
class SingleTermTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testPhraseIsEscaped()
    {
        $term = new Single('asdf!@#$%^"');

        $this->assertEquals('asdf\!@#$%\^\"', (string) $term);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        $spec = new Single('test');

        $this->assertSame($spec, $spec->getTerm());
    }
}
