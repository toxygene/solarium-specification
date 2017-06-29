<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Fuzzy;

/**
 * @defaultCoversClass SolariumSpecification\Fuzzy
 */
class FuzzyTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testFuzzy()
    {
        $mockQuery = $this->createMock(Query::class);
        
        $spec = new Fuzzy('abc');
        
        $this->assertEquals('abc~', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testFuzzyWithDistance()
    {
        $mockQuery = $this->createMock(Query::class);
        
        $spec = new Fuzzy('abc', 3);
        
        $this->assertEquals('abc~3', $spec->getFilter($mockQuery));
    }
}
