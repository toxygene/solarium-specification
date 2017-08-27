<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification\Operation;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Operator\Excluded;
use SolariumSpecification\QuerySpecificationInterface;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Operator\Excluded
 */
class ExcludedTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * @covers ::__construct
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class, function (MockInterface $mock) {
            /** @var QueryInterface|MockInterface $mockQuery */
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('test');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        $excluded = new Excluded($mockQuerySpecification);

        $this->assertEquals('-test', $excluded->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification */
        $mockQuerySpecification = Mockery::mock(QuerySpecificationInterface::class);

        $excluded = new Excluded($mockQuerySpecification);

        $this->assertSame($excluded, $excluded->getQuery());
    }
}
