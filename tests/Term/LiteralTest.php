<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Literal;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Literal
 * @covers ::__construct
 */
class LiteralTest extends TestCase
{
    /**
     * @var Literal
     */
    private $term;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->term = new Literal('asdf!"Q@#$');
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->term);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanBeRetrieved()
    {
        $this->assertInstanceOf(TermInterface::class, $this->term->getTerm());
    }

    /**
     * @covers ::__toString
     */
    public function testTermIsFormattedCorrectly()
    {
        $this->assertEquals('asdf!"Q@#$', (string) $this->term);
    }
}
