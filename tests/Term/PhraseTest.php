<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\Phrase;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\Phrase
 * @covers ::__construct
 */
class PhraseTest extends TestCase
{
    /**
     * @var Phrase
     */
    private $term;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->term = new Phrase('asdf"!@#$%^&*()_+=-');
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
     * @covers ::__toString
     */
    public function testPhraseIsEscaped()
    {
        $this->assertEquals('"asdf\"!@#$%^&*()_+=-"', (string) $this->term);
    }

    /**
     * @covers ::getTerm
     */
    public function testTermCanRetrieved()
    {
        $this->assertInstanceOf(TermInterface::class, $this->term->getTerm());
    }
}
