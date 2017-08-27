# Solarium Specification library

Create Solarium queries for the [standard query parser](https://lucene.apache.org/solr/guide/6_6/the-standard-query-parser.html#the-standard-query-parser) using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

## Example
```php
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuery\SetHandler;
use SolariumSpecification\ModifyQuery\SetResultClass;
use SolariumSpecification\QueryInterface;
use SolariumSpecification\QuerySpecification\DateTime;
use SolariumSpecification\QuerySpecification\Field;
use SolariumSpecification\QuerySpecification\Operator\AndX;
use SolariumSpecification\QuerySpecification\Operator\OrX;
use SolariumSpecification\QuerySpecificationInterface;
use SolariumSpecification\QuerySpecification\Range;
use SolariumSpecification\QuerySpecification\Term\Phrase;
use SolariumSpecification\QuerySpecification\Term\SingleTerm;
use SolariumSpecification\Repository;

// Only match results with a `last_updated_at` after a supplied DateTime
class UpdatedAfter implements QuerySpecificationInterface
{
    private $updatedAfter;

    public function __construct(DateTimeImmutable $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }

    public function getQuery(): QueryInterface
    {
        return new Field(
            'last_updated_at',
            new Range((new DateTime($this->updatedAfter))->getQueryString())
        );
    }
}

// Only match results assign to a supplied `category`
class FilterByCategory implements QuerySpecificationInterface
{
    private $category;

    public function __construct(QueryInterface $category)
    {
        $this->category = $category;
    }

    public function getQuery(): QueryInterface
    {
        return new Field(
            'category',
            $this->category
        );
    }
}

// Combine `UpdatedAfter` for the last week and `FilterByCategory` for 'Consumer Electronics'
class RecentlyUpdatedElectronics implements QuerySpecificationInterface
{
    public function getQuery(): QueryInterface
    {
        return new AndX([
            new UpdatedAfter(new DateTimeImmutable('-1 week')),
            new FilterByCategory(new OrX([new Phrase('Consumer Electronics'), new SingleTerm('Electronics')]))
        ]);
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

var_dump((new RecentlyUpdatedElectronics())->getQuery()->getQueryString()); // '(last_updated_at:[2016-07-06T19:36:23Z] AND category:("Consumer Electronics" OR "Electronics"))'

$solariumClient = new Client();
$query = $solariumClient->createSelect();

(new Products())->modify($query);

var_dump($query->getResultClass()); // 'ProductsResult'
var_dump($query->getHandler()); // 'Products'
