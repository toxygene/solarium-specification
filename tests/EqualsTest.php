<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Equals;

/**
 * @coversDefaultClass SolariumSpecification\Equals
 */
class EqualsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testEqualityStringIsBuilt()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $spec = new Equals('abc', 'def');
        
        $this->assertEquals('abc:def', $spec->getFilter($mockQuery));
    }
}
