<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\Equals;

/**
 * @defaultCoversClass SolariumSpecification\Equals
 */
class EqualsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testEqualityStringIsBuilt()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $spec = new Equals('abc', 'def');
        
        $this->assertEquals('abc:def', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__cosntruct
     * @covers ::getFilter
     */
    public function testTermEqualityStringIsBuild()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $spec = new Equals('abc', 'def', Equals::TERM);
        
        $this->assertEquals('abc:def', $spec->getFilter($mockQuery));
    }
    
    /**
     * @covers ::__cosntruct
     * @covers ::getFilter
     */
    public function testPhraseEqualityStringIsBuild()
    {
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $spec = new Equals('abc', 'def', Equals::PHRASE);
        
        $this->assertEquals('abc:"def"', $spec->getFilter($mockQuery));
    }
}
