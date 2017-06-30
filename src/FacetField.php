<?php

namespace SolariumSpecification;

use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Query\Component\Facet\Field as ComponentFacetField;

class FacetField implements QueryModifierInterface
{
    /**
     * Add mode
     *
     * @var string
     */
    const ADD = 'add';

    /**
     * Replace mode
     *
     * @var string
     */
    const REPLACE = 'replace';

    /**
     * Update mode
     *
     * @var string
     */
    const UPDATE = 'update';

    /**
     * Facet contains
     *
     * @var string|null
     */
    private $contains;

    /**
     * Facet contains ignore case
     *
     * @var bool|null
     */
    private $containsIgnoreCase;

    /**
     * Facet field
     *
     * @var string|null
     */
    private $field;

    /**
     * Key
     *
     * @var string
     */
    private $key;

    /**
     * Facet limit
     *
     * @var int|null
     */
    private $limit;

    /**
     * Facet method
     *
     * @var string|null
     */
    private $method;

    /**
     * Facet minimum count
     *
     * @var int|null
     */
    private $minCount;

    /**
     * Facet missing
     *
     * @var bool|null
     */
    private $missing;

    /**
     * Mode
     *
     * @var string|null
     */
    private $mode;

    /**
     * Facet offset
     *
     * @var int|null
     */
    private $offset;

    /**
     * Prefix
     *
     * @var string|null
     */
    private $prefix;

    /**
     * Facet sort
     *
     * @var string|null
     */
    private $sort;

    /**
     * Constructor
     *
     * @param string $key
     * @param string|null $field
     * @param string|null $mode
     * @param string|null $sort
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $contains
     * @param bool|null $containsIgnoreCase
     * @param string|null $method
     * @param bool|null $missing
     * @param string|null $prefix
     */
    public function __construct(
        string $key,
        string $field = null,
        string $mode = null,
        string $sort = null,
        int $limit = null,
        int $offset = null,
        string $contains = null,
        bool $containsIgnoreCase = null,
        string $method = null,
        bool $missing = null,
        string $prefix = null
    )
    {
        if (null === $mode) {
            $mode = self::ADD;
        }

        $this->key = $key;
        $this->field = $field;
        $this->mode = $mode;
        $this->sort = $sort;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->contains = $contains;
        $this->containsIgnoreCase = $containsIgnoreCase;
        $this->method = $method;
        $this->missing = $missing;
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        $facetField = $this->buildFacetField($query);

        if (null !== $this->contains) {
            $facetField->setContains($this->contains);
        }

        if (null !== $this->containsIgnoreCase) {
            $facetField->setContainsIgnoreCase($this->containsIgnoreCase);
        }

        if (null !== $this->field) {
            $facetField->setField($this->field);
        }

        if (null !== $this->limit) {
            $facetField->setLimit($this->limit);
        }

        if (null !== $this->method) {
            $facetField->setMethod($this->method);
        }

        if (null !== $this->minCount) {
            $facetField->setMinCount($this->minCount);
        }

        if (null !== $this->missing) {
            $facetField->setMissing($this->missing);
        }

        if (null !== $this->offset) {
            $facetField->setOffset($this->offset);
        }

        if (null !== $this->prefix) {
            $facetField->setPrefix($this->prefix);
        }

        if (null !== $this->sort) {
            $facetField->setSort($this->sort);
        }

        return $this;
    }

    /**
     * Build the facet query
     *
     * @param Query $query
     * @return ComponentFacetField
     */
    private function buildFacetField(Query $query)
    {
        switch ($this->mode) {
            case self::ADD:
                return $query->getFacetSet()
                    ->createFacetField($this->key);
                break;

            case self::REPLACE:
                $query->getFacetSet()
                    ->removeFacet($this->key);

                return $query->getFacetSet()
                    ->createFacetField($this->key);
                break;

            case self::UPDATE:
                return $query->getFacetSet()
                    ->getFacet($this->key);
                break;

            default:
                throw new RuntimeException(sprintf('Unknown mode "%s"', $this->mode));
        }
    }
}
