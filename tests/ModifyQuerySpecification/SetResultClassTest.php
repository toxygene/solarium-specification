<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\SetResultClass;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetResultClass
 */
class SetResultClassTest extends TestCase
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
        $setRows = new SetResultClass('Test');

        $this->assertInstanceOf(ModifyQueryInterface::class, $setRows->getModifyQuery());
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testSetResultClass()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('setResultClass')->once()->with('test')->andReturnSelf();
        });

        $spec = new SetResultClass('test');
        
        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
