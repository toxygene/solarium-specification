<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\ModifyQuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecification\FieldList;

/**
 * @coversDefaultClass \SolariumSpecification\ModifyQuerySpecification\FieldList
 */
class FieldListTest extends TestCase
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
        $fieldList = new FieldList([]);

        $this->assertInstanceOf(ModifyQueryInterface::class, $fieldList->getModifyQuery());
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldsCanBeAdded()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('addFields')->once()->with(['test'])->andReturnSelf();
        });

        $spec = new FieldList(['test']);
        
        $this->assertSame($spec, $spec->modify($mockQuery));    
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     */
    public function testFieldCanBeSet()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class, function (MockInterface $mock) {
            $mock->shouldReceive('setFields')->once()->with(['one', 'two'])->andReturnSelf();
        });

        $spec = new FieldList(['one', 'two'], FieldList::SET);

        $this->assertSame($spec, $spec->modify($mockQuery));
    }

    /**
     * @covers ::__construct
     * @covers ::modify
     * @expectedException RuntimeException
     */
    public function testAnInvalidModeThrowsAnException()
    {
        /** @var Query|MockInterface $mockQuery */
        $mockQuery = Mockery::mock(Query::class);

        $spec = new FieldList('test', 'invalid');

        $this->assertSame($spec, $spec->modify($mockQuery));
    }
}
