<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\SetStart;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetStart
 */
class SetStartTest extends TestCase
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
        $setRows = new SetStart(1);

        $this->assertInstanceOf(ModifyQueryInterface::class, $setRows->getModifyQuery());
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetStart()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('setStart')->once()->with(10)->andReturnSelf();
        });

        $spec = new SetStart(10);
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
