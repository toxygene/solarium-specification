<?php

namespace SolariumSpecification;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Solarium\Core\Query\Helper as SolariumHelper;

class Helper
{
    /**
     * @var SolariumHelper|null
     */
    private static $helper;

    /**
     * Build a search with multiple terms joined with AND
     *
     * @param string[] $terms
     * @return string
     */
    static public function andX(array $terms): string
    {
        return self::group(implode(' AND ', $terms));
    }

    /**
     * Built a boost term search
     * 
     * @param string $term
     * @param float|null $amount
     * @return string
     */
    static public function boost(string $term, float $amount = null): string
    {
        if (null === $amount) {
            return sprintf(
                '%s^',
                $term
            );
        }

        return sprintf(
            '%s^%f',
            $term,
            $amount
        );
    }

    /**
     * Build a comment search
     *
     * @param string $comment
     * @return string
     */
    static public function comment(string $comment): string
    {
        return sprintf(
            '/* %s */',
            $comment
        );
    }

    /**
     * Build a search with multiple terms joined with default operator for query expressions
     *
     * @param string[] $parts
     * @return string
     */
    static public function defaultX($parts): string
    {
        return self::group(implode(' ', $parts));
    }

    /**
     * Build and equals search
     *
     * @param string $field
     * @param string $term
     * @return string
     */
    static public function equals(string $field, string $term): string
    {
        return sprintf(
            '%s:%s',
            $field,
            $term
        );
    }

    /**
     * Build an escaped phrase search
     *
     * @param string $phrase
     * @return string
     */
    static public function escapePhrase(string $phrase)
    {
        return self::getHelper()
            ->escapePhrase($phrase);
    }

    /**
     * Build an escaped term search
     *
     * @param string $term
     * @return string
     */
    static public function escapeTerm(string $term)
    {
        return self::getHelper()
            ->escapeTerm($term);
    }

    /**
     * Build an exclude a term search
     *
     * @param string $term
     * @return string
     */
    static public function exclude(string $term): string
    {
        return sprintf(
            '-%s',
            $term
        );
    }

    /**
     * Build a Solr datetime search from a DateTime object
     *
     * @param DateTime $dateTime
     * @return string
     */
    static public function formatDateTime(DateTime $dateTime): string
    {
        $clonedDateTime = clone $dateTime;
        $clonedDateTime->setTimezone(new DateTimeZone('UTC'));
        return self::formatDateTimeInterface($clonedDateTime);
    }

    /**
     * Build a Solr datetime search from a DateTimeImmutable object
     *
     * @param DateTimeImmutable $dateTime
     * @return string
     */
    static public function formatDateTimeImmutable(DateTimeImmutable $dateTime)
    {
        return self::formatDateTimeInterface($dateTime->setTimezone(new DateTimeZone('UTC')));
    }

    /**
     * Build a Solr datetime search from a DateTimeInterface object
     *
     * @param DateTimeInterface $dateTime
     * @return string
     */
    static private function formatDateTimeInterface(DateTimeInterface $dateTime)
    {
        return $dateTime->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * Build a fuzzy search
     *
     * @param string $term
     * @param int $distance
     * @return string
     */
    static public function fuzzy(string $term, int $distance = null): string
    {
        if (null === $distance) {
            return sprintf(
                '%s~',
                $term
            );
        }

        return sprintf(
            '%s~%d',
            $term,
            $distance
        );
    }

    /**
     * Build a grouped search
     *
     * @param string $terms
     * @return string
     */
    static public function group($terms): string
    {
        return sprintf(
            '(%s)',
            $terms
        );
    }

    /**
     * Build a greater than search
     *
     * @param string $term
     * @return string
     */
    static public function gt(string $term): string
    {
        return self::range($term, null, false);
    }

    /**
     * Build a greater than or equal to search
     *
     * @param string $term
     * @return string
     */
    static public function gte(string $term): string
    {
        return self::range($term, null, true);
    }

    /**
     * Build an is not null search
     *
     * @param string $field
     * @return string
     */
    static public function isNotNull(string $field): string
    {
        return self::equals(
            $field,
            '*'
        );
    }

    /**
     * Build an is null search
     *
     * @param string $field
     * @return string
     */
    static public function isNull(string $field): string
    {
        return self::exclude(
            self::isNotNull(
                $field
            )
        );
    }

    /**
     * Build a less than search
     *
     * @param string $term
     * @return string
     */
    static public function lt(string $term)
    {
        return self::range(null, $term, null, false);
    }

    /**
     * Build a less than or equal to search
     *
     * @param string $term
     * @return string
     */
    static public function lte(string $term)
    {
        return self::range(null, $term, null, true);
    }

    /**
     * Build a not search from two terms
     *
     * @param string $x
     * @param string $y
     * @return string
     */
    static public function not($x, $y): string
    {
        return sprintf(
            '%s NOT %s',
            $x,
            $y
        );
    }

    /**
     * Build a not equals search
     *
     * @param string $x
     * @param string $y
     * @return string
     */
    static public function notEquals(string $x, string $y): string
    {
        return self::exclude(
            self::equals(
                $x,
                $y
            )
        );
    }

    /**
     * Build a search with multiple terms joined with OR
     *
     * @param array $parts
     * @return string
     */
    static public function orX($parts): string
    {
        return self::group(implode(' OR ', $parts));
    }

    /**
     * Build a required term search
     *
     * @param string $term
     * @return string
     */
    static public function require(string $term): string
    {
        return sprintf(
            '+%s',
            $term
        );
    }

    /**
     * Build a range search
     *
     * @param string|null $start
     * @param string|null $end
     * @param boolean|null $includeStart
     * @param boolean|null $includeEnd
     * @return string
     */
    static public function range(
        string $start = null,
        string $end = null,
        bool $includeStart = null,
        bool $includeEnd = null
    ): string
    {
        return sprintf(
            '%s%s TO %s%s',
            ($includeStart ?? true) ? '[' : '{',
            $start ?? '*',
            $end ?? '*',
            ($includeEnd ?? true) ? ']' : '}'
        );
    }

    /**
     * Get an instance of the Solarium query helper
     *
     * @return SolariumHelper
     */
    private static function getHelper()
    {
        if (null === self::$helper) {
            self::$helper = new Helper();
        }

        return self::$helper;
    }
}
