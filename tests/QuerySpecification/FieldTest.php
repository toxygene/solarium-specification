<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

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
     * @covers ::getQueryString
     */
    public function testQueryCanBeFielded()
    {
        $this->mockQuery
            ->expects($this->once())
            ->method('getQueryString')
            ->will($this->returnValue('query'));

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
