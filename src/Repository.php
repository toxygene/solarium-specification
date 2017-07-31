<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\Core\Client\ClientInterface;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\Query\QueryInterface;

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
        QueryInterface $query = null,
        ModifyQueryInterface $modifyQuery = null
    ): Result
    {
        return $this->client
            ->select($this->createQuery($query, $modifyQuery));
    }
    
    /**
     * Create a select query from a specification
     *
     * @param QueryInterface|null $query
     * @param ModifyQueryInterface|null $modifyQuery
     * @return Query
     */
    private function createQuery(
        QueryInterface $query = null,
        ModifyQueryInterface $modifyQuery = null
    ): Query
    {
        $q = $this->client
            ->createSelect();

        if (null !== $query) {
            $q->setQuery($query->getString());
        }

        if (null !== $modifyQuery) {
            $modifyQuery->modify($q);
        }

        return $q;
    }
}
