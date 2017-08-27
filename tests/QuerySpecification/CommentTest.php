<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Comment;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Comment
 * @covers ::__construct
 */
class CommentTest extends TestCase
{
    /**
     * @var QueryInterface|MockInterface
     */
    private $mockQuery;

    /**
     * @var Comment
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockQuery = Mockery::mock(QueryInterface::class);

        $this->query = new Comment(
            $this->mockQuery,
            'comment'
        );
    }

    /**
     * {@tearDown}
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
    public function testQueryCanBeCommented()
    {
        $this->mockQuery->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('test');

        $this->assertEquals('test /* comment */', $this->query->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertInstanceOf(QueryInterface::class, $this->query->getQuery());
    }
}
