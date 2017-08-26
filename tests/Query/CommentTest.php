<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Query;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use SolariumSpecification\Query\Comment;
use SolariumSpecification\Query\QueryInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Query\Comment
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
}
