<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification\Modifier;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QuerySpecification\Modifier\Fuzzy;
use SolariumSpecification\QuerySpecification\Term\SingleTerm;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Modifier\Fuzzy
 * @covers ::__construct
 */
class FuzzyTest extends TestCase
{
    /**
     * @var SingleTerm|MockInterface
     */
    private $mockTerm;

    /**
     * @var Fuzzy
     */
    private $fuzzy;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockTerm = Mockery::mock(SingleTerm::class);

        $this->fuzzy = new Fuzzy(
            $this->mockTerm,
            0.25
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();

        unset($this->mockQuery, $this->fuzzy);
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertSame($this->fuzzy, $this->fuzzy->getQuery());
    }

    /**
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        $this->mockTerm->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('query');

        $this->assertEquals('query~0.25', $this->fuzzy->getQueryString());
    }
}
