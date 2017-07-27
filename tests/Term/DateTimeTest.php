<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\Term;

use DateTimeImmutable as PhpDateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\Term\DateTime;
use SolariumSpecification\Term\TermInterface;

/**
 * @coversDefaultClass \SolariumSpecification\Term\DateTime
 * @covers ::__construct
 */
class DateTimeTest extends TestCase
{
    /**
     * @var DateTime
     */
    private $term;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $dateTime = PhpDateTime::createFromFormat(
            'Y-m-d H:i:s',
            '2017-01-02 03:04:05',
            new DateTimeZone('CST')
        );

        $this->term = new DateTime($dateTime);
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
        $this->assertEquals('2017-01-02T09:04:05Z', (string) $this->term);
    }
}
