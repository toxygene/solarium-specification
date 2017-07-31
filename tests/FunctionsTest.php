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
use function SolariumSpecification\proximity;
use function SolariumSpecification\range;
use function SolariumSpecification\required;

/**
 *
 */
class FunctionsTest extends TestCase
{
    /**
     * @covers \SolariumSpecification\andX
     */
    public function testTermsCanBeAndedTogether()
    {
        $this->assertEquals('(x AND y)', andX(['x', 'y']));
    }

    /**
     * @covers \SolariumSpecification\boost
     */
    public function testTermsCanBeBoosted()
    {
        $this->assertEquals('a^0.2', boost('a', 0.2));
    }

    /**
     * @covers \SolariumSpecification\comment
     */
    public function testCommentsCanBeOutput()
    {
        $this->assertEquals('test /* test */', comment('test', 'test'));
    }

    /**
     * @covers \SolariumSpecification\defaultX
     */
    public function testTermsCanBeJoinedWithTheDefaultOperator()
    {
        $this->assertEquals('(x y)', defaultX(['x', 'y']));
    }

    /**
     * @covers \SolariumSpecification\escapePhrase
     */
    public function testPhrasesCanBeEscaped()
    {
        $this->assertEquals('"test*-\"test"', escapePhrase('test*-"test'));
    }

    /**
     * @covers \SolariumSpecification\escapeTerm
     */
    public function testTermsCanBeEscaped()
    {
        $this->assertEquals('as\+\&&df', escapeTerm('as+&&df'));
    }

    /**
     * @covers \SolariumSpecification\excluded
     */
    public function testTermsCanBeExcluded()
    {
        $this->assertEquals('-term', excluded('term'));
    }

    /**
     * @covers \SolariumSpecification\field
     */
    public function testTermsCanBeAppliedToAField()
    {
        $this->assertEquals('field:term', field('field', 'term'));
    }

    /**
     * @covers \SolariumSpecification\formatDateTime
     * @covers \SolariumSpecification\formatDateTimeInterface
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
     * @covers \SolariumSpecification\formatDateTimeImmutable
     * @covers \SolariumSpecification\formatDateTimeInterface
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
     * @covers \SolariumSpecification\fuzzy
     */
    public function testTermsCanBeFuzzySearched()
    {
        $this->assertEquals('term~0.2', fuzzy('term', 0.2));
    }

    /**
     * @cover \SolariumSpecification\proximity
     */
    public function testPhraseCanBeProximitySearched()
    {
        $this->assertEquals('"two terms"~10', proximity('"two terms"', 10));
    }

    /**
     * @covers \SolariumSpecification\group
     */
    public function testTermsCanBeGrouped()
    {
        $this->assertEquals('(one AND two)', group('one AND two'));
    }

    /**
     * @covers \SolariumSpecification\gt
     */
    public function testGreaterThanRangeCanBeSearched()
    {
        $this->assertEquals('{a TO *]', gt('a'));
    }

    /**
     * @covers \SolariumSpecification\gte
     */
    public function testGreaterThanOrEqualToRangeCanBeSearched()
    {
        $this->assertEquals('[a TO *]', gte('a'));
    }

    /**
     * @covers \SolariumSpecification\isNotNull
     */
    public function testIsNotNull()
    {
        $this->assertEquals('*', isNotNull());
    }

    /**
     * @covers \SolariumSpecification\lt
     */
    public function testLessThanRangeCanBeSearched()
    {
        $this->assertEquals('[* TO a}', lt('a'));
    }

    /**
     * @covers \SolariumSpecification\lt
     */
    public function testLessThanOrEqualToRangeCanBeSearched()
    {
        $this->assertEquals('[* TO a]', lte('a'));
    }

    /**
     * @covers \SolariumSpecification\not
     */
    public function testTermsCanBeJoinedWithNot()
    {
        $this->assertEquals('(a NOT b)', not('a', 'b'));
    }

    /**
     * @covers \SolariumSpecification\orX
     */
    public function testTermsCanBeOredTogether()
    {
        $this->assertEquals('(x OR y)', orX(['x', 'y']));
    }

    /**
     * @covers \SolariumSpecification\range
     */
    public function testTermRangedCanBeDone()
    {
        $this->assertEquals('[* TO a}', range(null, 'a', true, false));
    }

    /**
     * @covers \SolariumSpecification\required
     */
    public function testTermsCanBeRequired()
    {
        $this->assertEquals('+term', required('term'));
    }
}
