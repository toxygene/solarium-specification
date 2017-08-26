<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Query;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Query\Field;
use SolariumSpecification\Query\QueryInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Query\Field
 * @covers ::__construct
 */
class FieldTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|QueryInterface
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

        $this->mockQuery = $this->getMockBuilder(QueryInterface::class)
            ->setMethods(['getQueryString'])
            ->getMock();

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

        unset($this->mockQuery, $this->query);
    }

    /**
     * @covers ::getString
     */
    public function testQueryCanBeFielded()
    {
        $this->mockQuery
            ->expects($this->once())
            ->method('getQueryString')
            ->will($this->returnValue('query'));

        $this->assertEquals('field:query', $this->query->getQueryString());
    }
}
