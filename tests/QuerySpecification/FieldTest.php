<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Field;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Field
 * @covers ::__construct
 */
class FieldTest extends TestCase
{
    /**
     * @var QueryInterface|MockInterface
     */
    private $mockQuery;

    /**
     * @var Field
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockQuery = Mockery::mock(QueryInterface::class);

        $this->query = new Field(
            'field',
            $this->mockQuery
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();

        unset($this->mockQuery, $this->query);
    }

    /**
     * @covers ::getQueryString
     */
    public function testQueryCanBeFielded()
    {
        $this->mockQuery->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('query');

        $this->assertEquals('field:query', $this->query->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertInstanceOf(QueryInterface::class, $this->query->getQuery());
    }
}
