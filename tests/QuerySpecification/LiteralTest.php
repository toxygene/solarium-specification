<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\Literal;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\Literal
 * @covers ::__construct
 */
class LiteralTest extends TestCase
{
    /**
     * @var Literal
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->query = new Literal('a OR (b AND c)');
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->query);
    }

    /**
     * @covers ::getString
     */
    public function testLiteralQueryCanBeMade()
    {
        $this->assertEquals('a OR (b AND c)', $this->query->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertInstanceOf(QueryInterface::class, $this->query->getQuery());
    }
}
