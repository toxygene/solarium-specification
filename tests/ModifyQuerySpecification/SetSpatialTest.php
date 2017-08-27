<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Component\Spatial;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQuerySpecification\SetSpatial;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetSpatial
 */
class SetSpatialTest extends TestCase
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
     * @covers ::modify
     */
    public function testSpatialCanBeSet()
    {
        $setSpatial = new SetSpatial(
            1.0,
            'field',
            '1,2'
        );

        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            /** @var Spatial|MockInterface $mockSpatial */
            $mockSpatial = Mockery::mock(Spatial::class, function (MockInterface $mock) {
                $mock->shouldReceive('setDistance')->once()->with(1.0)->andReturnSelf();
                $mock->shouldReceive('setField')->once()->with('field')->andReturnSelf();
                $mock->shouldReceive('setPoint')->once()->with('1,2')->andReturnSelf();
            });

            $mock->shouldReceive('getSpatial')->once()->withNoArgs()->andReturn($mockSpatial);
        });

        $this->assertSame($setSpatial, $setSpatial->modify($mockQuery));
    }

    /**
     * @covers ::getModifyQuery
     */
    public function testModifyQueryCanBeRetrieved()
    {
        $setSpatial = new SetSpatial(
            1.0,
            'field',
            '1,2'
        );

        $this->assertSame($setSpatial, $setSpatial->getModifyQuery());
    }
}
