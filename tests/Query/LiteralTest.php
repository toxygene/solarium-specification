<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Query;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Query\Literal;

/**
 * @coversDefaultClass \SolariumSpecification\Query\Literal
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
}
