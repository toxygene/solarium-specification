<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use function SolariumSpecification\andX;
use function SolariumSpecification\boost;
use function SolariumSpecification\comment;
use function SolariumSpecification\defaultX;
use function SolariumSpecification\escapePhrase;
use function SolariumSpecification\escapeTerm;
use function SolariumSpecification\excluded;
use function SolariumSpecification\field;
use function SolariumSpecification\formatDateTime;
use function SolariumSpecification\formatDateTimeImmutable;
use function SolariumSpecification\fuzzy;
use function SolariumSpecification\group;
use function SolariumSpecification\gt;
use function SolariumSpecification\gte;
use function SolariumSpecification\isNotNull;
use function SolariumSpecification\lt;
use function SolariumSpecification\lte;
use function SolariumSpecification\not;
use function SolariumSpecification\orX;
use function SolariumSpecification\range;
use function SolariumSpecification\required;

/**
 * @coversDefaultClass \SolariumSpecification\Helper
 */
class FunctionsTest extends TestCase
{
    /**
     * @covers ::andX
     */
    public function testTermsCanBeAndedTogether()
    {
        $this->assertEquals('(x AND y)', andX(['x', 'y']));
    }

    /**
     * @covers ::boost
     */
    public function testTermsCanBeBoosted()
    {
        $this->assertEquals('a^0.2', boost('a', 0.2));
    }

    /**
     * @covers ::comment
     */
    public function testCommentsCanBeOutput()
    {
        $this->assertEquals('/* test */', comment('test'));
    }

    /**
     * @covers ::defaultX
     */
    public function testTermsCanBeJoinedWithTheDefaultOperator()
    {
        $this->assertEquals('(x y)', defaultX(['x', 'y']));
    }

    /**
     * @covers ::escapePhrase
     */
    public function testPhrasesCanBeEscaped()
    {
        $this->assertEquals('"test*-\"test"', escapePhrase('test*-"test'));
    }

    /**
     * @covers ::escapeTerm
     */
    public function testTermsCanBeEscaped()
    {
        $this->assertEquals('as\+\&&df', escapeTerm('as+&&df'));
    }

    /**
     * @covers ::exclude
     */
    public function testTermsCanBeExcluded()
    {
        $this->assertEquals('-term', excluded('term'));
    }

    /**
     * @covers ::field
     */
    public function testTermsCanBeAppliedToAField()
    {
        $this->assertEquals('field:term', field('field', 'term'));
    }

    /**
     * @covers ::formatDateTime
     * @covers ::formatDateTimeInterface
     */
    public function testDateTimeObjectsCanBeConvertedToSolrDateTimeFormat()
    {
        $dateTime = DateTime::createFromFormat(
            'Y-m-d H:i:s',
            '2016-01-01 12:00:00',
            new DateTimeZone('CST')
        );

        $this->assertEquals('2016-01-01T18:00:00Z', formatDateTime($dateTime));
    }

    /**
     * @covers ::formatDateTimeImmutable
     * @covers ::formatDateTimeInterface
     */
    public function testImmutableDateTimeObjectsCanBeConvertedToSolrDateTimeFormat()
    {
        $dateTime = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            '2016-01-01 12:00:00',
            new DateTimeZone('CST')
        );

        $this->assertEquals('2016-01-01T18:00:00Z', formatDateTimeImmutable($dateTime));
    }

    /**
     * @covers ::fuzzy
     */
    public function testTermsCanBeFuzzySearched()
    {
        $this->assertEquals('term~12', fuzzy('term', 12));
    }

    /**
     * @covers ::group
     */
    public function testTermsCanBeGrouped()
    {
        $this->assertEquals('(one AND two)', group('one AND two'));
    }

    /**
     * @covers ::gt
     */
    public function testGreaterThanRangeCanBeSearched()
    {
        $this->assertEquals('{a TO *]', gt('a'));
    }

    /**
     * @covers ::gte
     */
    public function testGreaterThanOrEqualToRangeCanBeSearched()
    {
        $this->assertEquals('[a TO *]', gte('a'));
    }

    /**
     * @covers ::isNotNull
     */
    public function testIsNotNull()
    {
        $this->assertEquals('*', isNotNull());
    }

    /**
     * @covers ::lt
     */
    public function testLessThanRangeCanBeSearched()
    {
        $this->assertEquals('[* TO a}', lt('a'));
    }

    /**
     * @covers ::lt
     */
    public function testLessThanOrEqualToRangeCanBeSearched()
    {
        $this->assertEquals('[* TO a]', lte('a'));
    }

    /**
     * @covers ::not
     */
    public function testTermsCanBeJoinedWithNot()
    {
        $this->assertEquals('a NOT b', not('a', 'b'));
    }

    /**
     * @covers ::orX
     */
    public function testTermsCanBeOredTogether()
    {
        $this->assertEquals('(x OR y)', orX(['x', 'y']));
    }

    /**
     * @covers ::range
     */
    public function testTermRangedCanBeDone()
    {
        $this->assertEquals('[* TO a}', range(null, 'a', true, false));
    }

    /**
     * @covers ::require
     */
    public function testTermsCanBeRequired()
    {
        $this->assertEquals('+term', required('term'));
    }
}
