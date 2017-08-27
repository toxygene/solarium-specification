<?php

declare(strict_types=1);

namespace SolariumSpecification\Test\QuerySpecification;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\DateTime;

/**
 * @coversDefaultClass \SolariumSpecification\QuerySpecification\DateTime
 * @covers ::__construct
 */
class DateTimeTest extends TestCase
{
    /**
     * @var DateTime
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->query = new DateTime(
            DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                '2017-07-23 12:34:43',
                new DateTimeZone('CST')
            )
        );
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
     * @covers ::getQueryString
     */
    public function testDateTimeIsConvertedToIso8601ForUtc()
    {
        $this->assertEquals('2017-07-23T18:34:43Z', $this->query->getQueryString());
    }

    /**
     * @covers ::getQuery
     */
    public function testQueryCanBeRetrieved()
    {
        $this->assertInstanceOf(QueryInterface::class, $this->query->getQuery());
    }
}
