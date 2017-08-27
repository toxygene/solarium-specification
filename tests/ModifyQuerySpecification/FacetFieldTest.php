<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Component\Facet\Field;
use Solarium\QueryType\Select\Query\Component\FacetSet;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\FacetField;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\FacetField
 */
class FacetFieldTest extends TestCase
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
     * @covers ::buildFacetField
     * @covers ::modify
     */
    public function testFacetFieldCanBeCreated()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            /** @var FacetSet|MockInterface $mockFacetSet */
            $mockFacetSet = Mockery::mock(FacetSet::class, function (MockInterface $mock) {
                $mockFacetField = Mockery::mock(FacetField::class, function (MockInterface $mock) {
                    $mock->shouldReceive('setContains')->once()->with('contains')->andReturnSelf();
                    $mock->shouldReceive('setContainsIgnoreCase')->once()->with(true)->andReturnSelf();
                    $mock->shouldReceive('setField')->once()->with('field')->andReturnSelf();
                    $mock->shouldReceive('setSort')->once()->with(Field::SORT_INDEX)->andReturnSelf();
                    $mock->shouldReceive('setLimit')->once()->with(10)->andReturnSelf();
                    $mock->shouldReceive('setOffset')->once()->with(20)->andReturnSelf();
                    $mock->shouldReceive('setMethod')->once()->with(FIELD::METHOD_ENUM)->andReturnSelf();
                    $mock->shouldReceive('setMinCount')->once()->with(10)->andReturnSelf();
                    $mock->shouldReceive('setMissing')->once()->with(true)->andReturnSelf();
                    $mock->shouldReceive('setPrefix')->once()->with('test')->andReturnSelf();
                });

                $mock->shouldReceive('createFacetField')->once()->with('key')->andReturn($mockFacetField);
            });

            $mock->shouldReceive('getFacetSet')->once()->withNoArgs()->andReturn($mockFacetSet);
        });

        $modifyQuery = new FacetField(
            'key',
            'field',
            null,
            Field::SORT_INDEX,
            10,
            20,
            'contains',
            true,
            Field::METHOD_ENUM,
            true,
            'test',
            10
        );

        $this->assertSame($modifyQuery, $modifyQuery->modify($mockQuery));
    }

    /**
     * @covers ::getModifyQuery
     */
    public function testModifyQueryCanBeRetrieved()
    {
        $modifyQuery = new FacetField('key');

        $this->assertInstanceOf(ModifyQueryInterface::class, $modifyQuery->getModifyQuery());
    }
}
