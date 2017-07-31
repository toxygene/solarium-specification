<?php

namespace SolariumSpecification;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use RuntimeException;

/**
 * Build a search with multiple terms joined with AND
 *
 * @param string[] $terms
 * @return string
 */
function andX(array $terms): string
{
    return group(implode(' AND ', $terms));
}

/**
 * Built a boost term search
 *
 * @param string $term
 * @param float|null $amount
 * @return string
 */
function boost(string $term, float $amount = null): string
{
    if (null === $amount) {
        return sprintf(
            '%s^',
            $term
        );
    }

    if (0 > $amount) {
        throw new RuntimeException('Boost amount must be > 0');
    }

    return sprintf(
        '%s^%s',
        $term,
        $amount
    );
}

/**
 * Build a comment search
 *
 * @param string $term
 * @param string $comment
 * @return string
 */
function comment(string $term, string $comment): string
{
    return sprintf(
        '%s /* %s */',
        $term,
        $comment
    );
}

/**
 * Build a search with multiple terms joined with default operator for query expressions
 *
 * @param string[] $parts
 * @return string
 */
function defaultX(array $parts): string
{
    return group(implode(' ', $parts));
}

/**
 * Build an escaped phrase search
 *
 * @param string $phrase
 * @return string
 */
function escapePhrase(string $phrase)
{
    return '"'.preg_replace('/("|\\\)/', '\\\$1', $phrase).'"';
}

/**
 * Build an escaped term search
 *
 * @param string $term
 * @return string
 */
function escapeTerm(string $term)
{
    $pattern = '/(\+|-|&&|\|\||!|\(|\)|\{|}|\[|]|\^|"|~|\*|\?|:|\/|\\\)/';

    return preg_replace($pattern, '\\\$1', $term);
}

/**
 * Build an exclude a term search
 *
 * @param string $term
 * @return string
 */
function excluded(string $term): string
{
    return sprintf(
        '-%s',
        $term
    );
}

/**
 * Builds a field-specific search
 *
 * @param string $field
 * @param string $term
 * @return string
 */
function field(string $field, string $term): string
{
    return sprintf(
        '%s:%s',
        $field,
        $term
    );
}

/**
 * Build a Solr datetime search from a DateTime object
 *
 * @param DateTime $dateTime
 * @return string
 */
function formatDateTime(DateTime $dateTime): string
{
    $clonedDateTime = clone $dateTime;
    $clonedDateTime->setTimezone(new DateTimeZone('UTC'));
    return formatDateTimeInterface($clonedDateTime);
}

/**
 * Build a Solr datetime search from a DateTimeImmutable object
 *
 * @param DateTimeImmutable $dateTime
 * @return string
 */
function formatDateTimeImmutable(DateTimeImmutable $dateTime)
{
    return formatDateTimeInterface($dateTime->setTimezone(new DateTimeZone('UTC')));
}

/**
 * Build a Solr datetime search from a DateTimeInterface object
 *
 * @param DateTimeInterface $dateTime
 * @return string
 */
function formatDateTimeInterface(DateTimeInterface $dateTime)
{
    return $dateTime->format('Y-m-d\TH:i:s\Z');
}

/**
 * Build a fuzzy search
 *
 * @param string $singleTerm
 * @param float $similarity
 * @return string
 */
function fuzzy(string $singleTerm, float $similarity = null): string
{
    if (0 > $similarity || 1 < $similarity) {
        throw new RuntimeException('Similarity must be >= 0 and <= 1');
    }

    if (null === $similarity) {
        return sprintf(
            '%s~',
            $singleTerm
        );
    }

    return sprintf(
        '%s~%s',
        $singleTerm,
        $similarity
    );
}

/**
 * Build a proximity search
 *
 * @param string $phrase
 * @param int $distance
 * @return string
 */
function proximity(string $phrase, int $distance): string
{
    if (0 > $distance) {
        throw new RuntimeException('Distance must be > 0');
    }

    return sprintf(
        '%s~%s',
        $phrase,
        $distance
    );
}

/**
 * Build a grouped search
 *
 * @param string $term
 * @return string
 */
function group(string $term): string
{
    return sprintf(
        '(%s)',
        $term
    );
}

/**
 * Build a greater than search
 *
 * @param string $term
 * @return string
 */
function gt(string $term): string
{
    return range($term, null, false);
}

/**
 * Build a greater than or equal to search
 *
 * @param string $term
 * @return string
 */
function gte(string $term): string
{
    return range($term, null, true);
}

/**
 * Join multiple terms using the default operator
 *
 * @param string[] $terms
 * @return string
 */
function joinX(array $terms): string
{
    return group(implode(' ', $terms));
}

/**
 * Build an is not null search
 *
 * @return string
 */
function isNotNull(): string
{
    return '*';
}

/**
 * Build an is null search
 *
 * @return string
 */
function isNull(): string
{
    return excluded(isNotNull());
}

/**
 * Build a less than search
 *
 * @param string $term
 * @return string
 */
function lt(string $term): string
{
    return range(null, $term, null, false);
}

/**
 * Build a less than or equal to search
 *
 * @param string $term
 * @return string
 */
function lte(string $term): string
{
    return range(null, $term, null, true);
}

/**
 * Build a not search from two terms
 *
 * @param string $x
 * @param string $y
 * @return string
 */
function not(string $x, string $y): string
{
    return group(
        sprintf(
            '%s NOT %s',
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
function orX(array $parts): string
{
    return group(implode(' OR ', $parts));
}

/**
 * Build a required term search
 *
 * @param string $term
 * @return string
 */
function required(string $term): string
{
    return sprintf(
        '+%s',
        $term
    );
}

/**
 * Build a range search
 *
 * @param string|null $start Defaults to '*'
 * @param string|null $end Defaults to '*'
 * @param boolean|null $includeStart Defaults to true
 * @param boolean|null $includeEnd Defaults to true
 * @return string
 */
function range(
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
