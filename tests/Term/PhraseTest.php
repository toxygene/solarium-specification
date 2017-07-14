<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Phrase;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Phrase
 */
class PhraseTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testPhraseIsEscaped()
    {
        $phrase = new Phrase('test');

        $this->assertEquals('"test"', (string) $phrase);
    }
}
