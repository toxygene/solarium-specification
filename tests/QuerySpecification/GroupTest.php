<?php

declare(strict_types=1);

namespace SolariumSpecification\QuerySpecification\Group;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Group;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Group
 * @covers ::__construct
 */
class GroupTest extends TestCase
{
    /**
     * @var QueryInterface|MockInterface
     */
    private $mockQuery;

    /**
     * @var Group
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockQuery = Mockery::mock(QueryInterface::class);

        $this->query = new Group($this->mockQuery);
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
    public function testQueryCanBeGrouped()
    {
        $this->mockQuery->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('one AND two');

        $this->assertEquals('(one AND two)', $this->query->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertInstanceOf(QueryInterface::class, $this->query->getQuery());
    }
}
