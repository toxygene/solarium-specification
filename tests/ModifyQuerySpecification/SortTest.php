<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\Sort;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\Sort
 */
class SortTest extends TestCase
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
     * @covers ::getModifyQuery
     */
    public function testModifyQueryCanBeRetrieved()
    {
        $setRows = new Sort('test');

        $this->assertInstanceOf(ModifyQueryInterface::class, $setRows->getModifyQuery());
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSortCanBeAdded()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('addSort')->once()->with('test', Query::SORT_ASC)->andReturnSelf();
        });

        $spec = new Sort('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSortCanBeSet()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('clearSorts')->once()->withNoArgs()->andReturnSelf();
            $mock->shouldReceive('addSort')->once()->with('test', Query::SORT_ASC)->andReturnSelf();
        });

        $spec = new Sort('test', null, Sort::SET);

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
