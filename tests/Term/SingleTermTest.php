<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Single;

/**
 * @coversDefaultClass \SolariumSpecification\Term\SingleTerm
 */
class SingleTermTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testPhraseIsEscaped()
    {
        $term = new Single('test');

        $this->assertEquals('test', (string) $term);
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
