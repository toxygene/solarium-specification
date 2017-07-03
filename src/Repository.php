<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\Core\Client\ClientInterface;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;

/**
 * Solarium specification repository
 */
class Repository implements RepositoryInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function match(
        FilterSpecificationInterface $filterSpecification = null,
        ModifyQuerySpecificationInterface $modifyQuerySpecification = null): Result
    {
        return $this->client
            ->select($this->createQuery($filterSpecification, $modifyQuerySpecification));
    }
    
    /**
     * Create a select query from a specification
     *
     * @param FilterSpecificationInterface|null $filter
     * @param ModifyQuerySpecificationInterface|null $modifyQuery
     * @return Query
     */
    private function createQuery(
        FilterSpecificationInterface $filter = null,
        ModifyQuerySpecificationInterface $modifyQuery = null
    ): Query
    {
        $query = $this->client
            ->createSelect();

        if (null !== $modifyQuery) {
            $modifyQuery->getModifyQuery()
                ->modify($query);
        }

        if (null !== $filter) {
            $query->setQuery(
                $filter->getFilter()
                    ->filter()
            );
        }

        return $query;
    }
}
