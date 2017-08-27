<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Comment;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Comment
 * @covers ::__construct
 */
class CommentTest extends TestCase
{
    /**
     * @var QueryInterface|PHPUnit_Framework_MockObject_MockObject
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

        $this->mockQuery = $this->getMockBuilder(QueryInterface::class)
            ->setMethods(['getQueryString'])
            ->getMock();

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

        unset($this->mockQuery, $this->query);
    }

    /**
     * @covers ::getQueryString
     */
    public function testQueryCanBeCommented()
    {
        $this->mockQuery
            ->expects($this->once())
            ->method('getQueryString')
            ->will($this->returnValue('test'));

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
