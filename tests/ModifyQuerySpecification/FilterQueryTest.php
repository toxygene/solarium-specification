<?php

declare(strict_types=1);

namespace ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\FilterQuery as QueryFilterQuery;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\FilterQuery;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\FilterQuery
 */
class FilterQueryTest extends TestCase
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
     * @covers ::buildFilterQuery
     * @covers ::modify
     */
    public function testQueryCanBeModified()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class, function(MockInterface $mock) {
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('test');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            /** @var FilterQuery|MockInterface $mockFilterQuery */
            $mockFilterQuery = Mockery::mock(QueryFilterQuery::class, function (MockInterface $mock) {
                $mock->shouldReceive('setQuery')->once()->with('test')->andReturnSelf();
                $mock->shouldReceive('setTags')->once()->with(['one', 'two'])->andReturnSelf();
            });

            $mock->shouldReceive('createFilterQuery')->once()->with('key')->andReturn($mockFilterQuery);
        });

        $filterQuerySpec = new FilterQuery(
            'key',
            $mockQuerySpecification,
            ['one', 'two']
        );

        $this->assertSame($filterQuerySpec, $filterQuerySpec->modify($mockQuery));
    }

    /**
     * @covers ::getModifyQuery
     */
    public function testModifyQueryCanBeRetrieved()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class);

        $filterQuerySpec = new FilterQuery(
            'key',
            $mockQuerySpecification
        );

        $this->assertSame($filterQuerySpec, $filterQuerySpec->getModifyQuery());
    }
}
