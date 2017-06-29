<?php

declare(strict_types=1);

namespace SolariumSpecification;

use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\In;

/**
 * @defaultCoversClass SolariumSpecification\In
 */
class InTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     */
    public function testIn()
    {
        $mockQuery = $this->createMock(Query::class);
        
        $spec = new In(
            'a',
            ['c', 'd', 'e'],
            [In::LITERAL, In::TERM, In::PHRASE]
        );

        $this->assertSame('a:(c OR d OR "e")', $spec->getFilter($mockQuery));
    }
}
