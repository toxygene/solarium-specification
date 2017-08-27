<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\Core\Client\ClientInterface;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecificationInterface;
use SolariumSpecification\Repository;

class RepositoryTest extends TestCase
{
    public function testQueriesCanBeMatched()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('setQuery')->once()->with('test')->andReturnSelf();
        });

        /** @var Result|MockInterface $mockResult */
        $mockResult = Mockery::mock(Result::class);

        /** @var ClientInterface|MockInterface $mockClient */
        $mockClient = Mockery::mock(ClientInterface::class, function (MockInterface $mock) use ($mockQuery, $mockResult) {
            $mock->shouldReceive('createSelect')->once()->withNoArgs()->andReturn($mockQuery);

            $mock->shouldReceive('select')->once()->with($mockQuery)->andReturn($mockResult);
        });

        $repository = new Repository(
            $mockClient
        );

        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class, function (MockInterface $mock) {
            /** @var QueryInterface|MockInterface $mockQuery */
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('test');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        /** @var ModifyQuerySpecificationInterface|MockInterface $mockModifyQuerySpecification */
        $mockModifyQuerySpecification = Mockery::mock(ModifyQuerySpecificationInterface::class, function (MockInterface $mock) use ($mockQuery) {
            $mockModifyQuery = Mockery::mock(ModifyQueryInterface::class, function (MockInterface $mock) use ($mockQuery) {
                $mock->shouldReceive('modify')->once()->with($mockQuery)->andReturnSelf();
            });

            $mock->shouldReceive('getModifyQuery')->once()->withNoArgs()->andReturn($mockModifyQuery);
        });

        $result = $repository->match(
            $mockQuerySpecification,
            $mockModifyQuerySpecification
        );

        $this->assertSame($mockResult, $result);
    }
}
