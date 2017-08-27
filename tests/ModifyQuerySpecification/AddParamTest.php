<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\AddParam;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\AddParam
 * @covers ::__construct
 */
class AddParamTest extends TestCase
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
        $addParam = new AddParam('name', 'value');

        $this->assertInstanceOf(ModifyQueryInterface::class, $addParam->getModifyQuery());
    }

    /**
     * @covers ::modify
     */
    public function testParameterIsAddedToTheQuery()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('addParam')->once()->with('name', 'value')->andReturnSelf();
        });

        $spec = new AddParam('name', 'value');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
