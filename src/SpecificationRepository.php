<?php

declare(strict_types=1);

namespace SolariumSpecification;

use Solarium\Core\Client\ClientInterface;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;

/**
 * Solarium specification repository
 */
class SpecificationRepository implements SpecificationRepositoryInterface
{
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
    public function match(SpecificationInterface $specification): Result
    {
        return $this->client
            ->select($this->createQuery($specification));
    }
    
    /**
     * Create a select query from a specification
     *
     * @param SpecificationInterface
     * @return Query
     */
    private function createQuery(SpecificationInterface $specification): Query
    {
        $query = $this->client
            ->createSelect();

        $specification->modify($query);

        $predicates = $specification->getFilter($query);
        
        if ($predicates) {
            $query->setQuery($predicates);
        }
        
        return $query;
    }
}
