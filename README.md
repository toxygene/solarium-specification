# Solarium Specification library

Create Solarium queries for the [standard query parser](https://lucene.apache.org/solr/guide/6_6/the-standard-query-parser.html#the-standard-query-parser) using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

## Example
```php
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\ModifyQuery\SetHandler;
use SolariumSpecification\ModifyQuery\SetResultClass;
use SolariumSpecification\Query\DateTime;
use SolariumSpecification\Query\Field;
use SolariumSpecification\Query\Operator\AndX;
use SolariumSpecification\Query\Operator\OrX;
use SolariumSpecification\Query\QueryInterface;
use SolariumSpecification\Query\Range;
use SolariumSpecification\Query\Term\Phrase;
use SolariumSpecification\Query\Term\SingleTerm;
use SolariumSpecification\Repository;

// Only match results with a `last_updated_at` after a supplied DateTimeImmutable
class UpdatedAfter implements QueryInterface
{
    private $updatedAfter;

    public function __construct(DateTimeImmutable $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }

    public function getQueryString(): string
    {
        return (new Field(
            'last_updated_at',
            new Range((new DateTime($this->updatedAfter))->getQueryString())
        ))->getQueryString();
    }
}

// Only match results assign to a supplied `category`
class FilterByCategory implements QueryInterface
{
    private $category;

    public function __construct(QueryInterface $category)
    {
        $this->category = $category;
    }

    public function getQueryString(): string
    {
        return (new Field(
            'category',
            $this->category
        ))->getQueryString();
    }
}

// Combine `UpdatedAfter` for the last week and `FilterByCategory` for 'Consumer Electronics'
class RecentlyUpdatedElectronics implements QueryInterface
{
    public function getQueryString(): string
    {
        return (new AndX([
            new UpdatedAfter(new DateTimeImmutable('-1 week')),
            new FilterByCategory(new OrX([new Phrase('Consumer Electronics'), new SingleTerm('Electronics')]))
        ]))->getQueryString();
    }
}

// Solarium result class
class ProductsResult extends Result
{
}

// Set the result class to `ProductResult`
class ProductResult implements ModifyQueryInterface
{
    public function modify(Query $query): ModifyQueryInterface
    {
        (new SetResultClass(ProductsResult::class))->modify($query);

        return $this;
    }
}

// Set the query handler to `Products`
class ProductHandler implements ModifyQueryInterface
{
    public function modify(Query $query): ModifyQueryInterface
    {
        (new SetHandler('Products'))->modify($query);

        return $this;
    }
}

// Combine the ProductResult and ProductHandler modify specifications
class Products implements ModifyQueryInterface
{
    public function modify(Query $query): ModifyQueryInterface
    {
        (new ProductResult())->modify($query);
        (new ProductHandler())->modify($query);

        return $this;
    }
}

$solariumClient = new Client();

$repository = new Repository($solariumClient);
var_dump((string) (new RecentlyUpdatedElectronics())->getTerm());
var_dump(
    $repository->match(
        new RecentlyUpdatedElectronics(),
        new Products()
    )
);

/*
The query will be 'last_updated_at:[2016-07-06T19:36:23Z TO *] AND category:("Consumer Electronics" OR "Electronics")'.
The handler is Products.
The result class is ProductResult.
*/
```
