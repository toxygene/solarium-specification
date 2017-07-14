<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Range
 */
class RangeTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testRange()
    {
        $this->assertEquals('[* TO *]', (string) (new Range()));
    }
}
