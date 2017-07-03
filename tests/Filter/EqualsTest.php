<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Filter;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Filter\Equals;

/**
 * @coversDefaultClass \SolariumSpecification\Filter\Equals
 */
class EqualsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testEqualityStringIsBuilt()
    {
        $spec = new Equals('abc', 'def');
        
        $this->assertEquals('abc:def', $spec->filter());
    }

    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testFieldCanBeNull()
    {
        $spec = new Equals(null, 'asdf');

        $this->assertEquals('asdf', $spec->filter());
    }
}
