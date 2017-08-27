<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification\Operation;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Operator\AndX;
use SolariumSpecification\QuerySpecificationInterface;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Operator\AndX
 */
class AndXTest extends TestCase
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
     * @covers ::append
     * @covers ::getQueryString
     */
    public function testQueryStringCanBeRetrieved()
    {
        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification1 */
        $mockQuerySpecification1 = Mockery::mock(QuerySpecificationInterface::class, function (MockInterface $mock) {
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('a');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        /** @var QuerySpecificationInterface|MockInterface $mockQuerySpecification2 */
        $mockQuerySpecification2 = Mockery::mock(QuerySpecificationInterface::class, function (MockInterface $mock) {
            $mockQuery = Mockery::mock(QueryInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('getQueryString')->once()->withNoArgs()->andReturn('b');
            });

            $mock->shouldReceive('getQuery')->once()->withNoArgs()->andReturn($mockQuery);
        });

        $andX = new AndX([$mockQuerySpecification1]);

        $andX->append($mockQuerySpecification2);

        $this->assertEquals('a AND b', $andX->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $andX = new AndX();

        $this->assertSame($andX, $andX->getQuery());
    }
}
