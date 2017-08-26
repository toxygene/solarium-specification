<?php

declare(strict_types=1);

namespace SolariumSpecification\Query\Group;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Query\Group;
use SolariumSpecification\Query\QueryInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Query\Group
 * @covers ::__construct
 */
class GroupTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|QueryInterface
     */
    private $mockQuery;

    /**
     * @var QueryInterface
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

        $this->query = new Group($this->mockQuery);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->mockQuery, $this->query);
    }

    /**
     * @covers ::getString
     */
    public function testQueryCanBeGrouped()
    {
        $this->mockQuery
            ->expects($this->once())
            ->method('getQueryString')
            ->will($this->returnValue('one AND two'));

        $this->assertEquals('(one AND two)', $this->query->getQueryString());
    }
}
