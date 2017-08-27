<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\QuerySpecification\Range;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Range
 */
class RangeTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        $range = new Range();

        $this->assertEquals('[* TO *]', $range->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $range = new Range();

        $this->assertSame($range, $range->getQuery());
    }
}
