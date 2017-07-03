<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Filter;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Filter\Range;

/**
 * @coversDefaultClass \SolariumSpecification\Filter\Range
 */
class RangeTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeWithLiterals()
    {
        $spec = new Range(
            'a',
            null,
            '100'
        );
        
        $this->assertEquals('a:[* TO 100]', $spec->filter());
    }
    
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testRangeStartAndEndExcluded()
    {
        $spec = new Range(
            'a',
            null,
            null,
            false,
            false
        );
        
        $this->assertEquals('a:{* TO *}', $spec->filter());
    }

    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testFieldIsNotRequired()
    {
        $spec = new Range();
        $this->assertEquals('[* TO *]', $spec->filter());
    }
}
