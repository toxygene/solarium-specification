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
        TermSpecificationInterface $termSpecification = null,
        ModifyQuerySpecificationInterface $modifyQuerySpecification = null): Result
    {
        return $this->client
            ->select($this->createQuery($termSpecification, $modifyQuerySpecification));
    }
    
    /**
     * Create a select query from a specification
     *
     * @param TermSpecificationInterface|null $termSpecification
     * @param ModifyQuerySpecificationInterface|null $modifyQuerySpecification
     * @return Query
     */
    private function createQuery(
        TermSpecificationInterface $termSpecification = null,
        ModifyQuerySpecificationInterface $modifyQuerySpecification = null
    ): Query
    {
        $query = $this->client
            ->createSelect();

        if (null !== $termSpecification) {
            $query->setQuery((string) $termSpecification->getTerm());
        }

        if (null !== $modifyQuerySpecification) {
            $modifyQuerySpecification->getModifyQuery()->modify($query);
        }

        return $query;
    }
}
