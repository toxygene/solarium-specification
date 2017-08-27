<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\FacetSet;
use SolariumSpecification\ModifyQuerySpecification\FacetQuery;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\FacetQuery
 */
class FacetQueryTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * @covers ::__construct
     * @covers ::buildFacetQuery
     * @covers ::modify
     */
    public function testQueryCanBeModified()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class, function (MockInterface $mock) {
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('test');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mockFacetSet = Mockery::mock(FacetSet::class, function (MockInterface $mock) {
                $mockFacetQuery = Mockery::mock(FacetQuery::class, function (MockInterface $mock) {
                    $mock->shouldReceive('setQuery')->once()->with('test')->andReturnSelf();
                    $mock->shouldReceive('setExcludes')->once()->with(['a', 'b'])->andReturnSelf();
                });

                $mock->shouldReceive('createFacetQuery')->once()->with('key')->andReturn($mockFacetQuery);
            });

            $mock->shouldReceive('getFacetSet')->once()->withNoArgs()->andReturn($mockFacetSet);
        });

        $facetQuery = new FacetQuery(
            'key',
            $mockQuerySpecification,
            ['a', 'b']
        );

        $this->assertSame($facetQuery, $facetQuery->modify($mockQuery));
    }
}
