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
        QuerySpecificationInterface $query = null,
        ModifyQuerySpecificationInterface $modifyQuery = null
    ): Result
    {
        return $this->client
            ->select($this->createQuery($query, $modifyQuery));
    }
    
    /**
     * Create a select query from a specification
     *
     * @param QuerySpecificationInterface|null $query
     * @param ModifyQuerySpecificationInterface|null $modifyQuery
     * @return Query
     */
    private function createQuery(
        QuerySpecificationInterface $query = null,
        ModifyQuerySpecificationInterface $modifyQuery = null
    ): Query
    {
        $q = $this->client
            ->createSelect();

        if (null !== $query) {
            $q->setQuery($query->getQuery()->getQueryString());
        }

        if (null !== $modifyQuery) {
            $modifyQuery->getModifyQuery()->modify($q);
        }

        return $q;
    }
}
