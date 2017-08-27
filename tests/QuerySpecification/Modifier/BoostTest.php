<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification\Modifier;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Modifier\Boost;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Modifier\Boost
 * @covers ::__construct
 */
class BoostTest extends TestCase
{
    /**
     * @var QueryInterface|MockInterface
     */
    private $mockQuery;

    /**
     * @var Boost
     */
    private $boost;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockQuery = Mockery::mock(QueryInterface::class);

        $this->boost = new Boost(
            $this->mockQuery,
            10.12
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();

        unset($this->mockQuery, $this->boost);
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertSame($this->boost, $this->boost->getQuery());
    }

    /**
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        $this->mockQuery->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('query');

        $this->assertEquals('query^10.12', $this->boost->getQueryString());
    }
}
