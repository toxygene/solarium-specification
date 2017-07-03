<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuery;

use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Query\Component\Facet\Query as ComponentFacetQuery;
use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

class FacetQuery implements ModifyQueryInterface, ModifyQuerySpecificationInterface
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
     * @var FilterSpecificationInterface
     */
    private $filterSpecification;

    /**
     * @var array
     */
    private $excludes;

    /**
     * Key
     *
     * @var string
     */
    private $key;

    /**
     * Mode
     *
     * @var string|null
     */
    private $mode;

    /**
     * Constructor
     *
     * @param string $key
     * @param FilterSpecificationInterface $filterSpecification
     * @param array|null $exclude
     * @param string|null $mode
     */
    public function __construct(
        string $key,
        FilterSpecificationInterface $filterSpecification,
        array $exclude = null,
        string $mode = null
    )
    {
        if (null === $mode) {
            $mode = self::ADD;
        }

        $this->key = $key;
        $this->filterSpecification = $filterSpecification;
        $this->excludes = $exclude;
        $this->mode = $mode;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        $facetQuery = $this->buildFacetQuery($query)
            ->setQuery($this->filterSpecification->getFilter()->filter());

        // todo add facet query modification?

        if (null !== $this->excludes) {
            $facetQuery->setExcludes($this->excludes);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
    }

    /**
     * Build the facet query
     *
     * @param Query $query
     * @return ComponentFacetQuery
     */
    private function buildFacetQuery(Query $query)
    {
        switch ($this->mode) {
            case self::ADD:
                return $query->getFacetSet()
                    ->createFacetQuery($this->key);
                break;

            case self::REPLACE:
                $query->getFacetSet()
                    ->removeFacet($this->key);

                return $query->getFacetSet()
                    ->createFacetQuery($this->key);
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
