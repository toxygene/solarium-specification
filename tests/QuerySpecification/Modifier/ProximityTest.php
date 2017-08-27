<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification\Modifier;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QuerySpecification\Modifier\Proximity;
use SolariumSpecification\QuerySpecification\Term\Phrase;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Modifier\Proximity
 * @covers ::__construct
 */
class ProximityTest extends TestCase
{
    /**
     * @var Phrase|MockInterface
     */
    private $mockPhrase;

    /**
     * @var Proximity
     */
    private $proximity;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockPhrase = Mockery::mock(Phrase::class);

        $this->proximity = new Proximity(
            $this->mockPhrase,
            5
        );
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertSame($this->proximity, $this->proximity->getQuery());
    }

    /**
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        $this->mockPhrase->shouldReceive('getQueryString')->once()->andReturn('query');

        $this->assertEquals('query~5', $this->proximity->getQueryString());
    }
}
