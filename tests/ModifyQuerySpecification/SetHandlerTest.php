<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\SetHandler;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\SetHandler
 */
class SetHandlerTest extends TestCase
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
        $fieldList = new SetHandler('test');

        $this->assertInstanceOf(ModifyQueryInterface::class, $fieldList->getModifyQuery());
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testHandlerCanBeSet()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('setHandler')->once()->with('test')->andReturnSelf();
        });

        $spec = new SetHandler('test');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
