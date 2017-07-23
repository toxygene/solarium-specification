# Solarium Specification library

Create Solarium queries for the [standard query parser](https://lucene.apache.org/solr/guide/6_6/the-standard-query-parser.html#the-standard-query-parser) using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

## Example
```php
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\CompositeModify;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\ModifyQuery\SetHandler;
use SolariumSpecification\ModifyQuery\SetResultClass;
use SolariumSpecification\ModifyQuerySpecificationInterface;
use SolariumSpecification\Repository;
use SolariumSpecification\Term\DateTime;
use SolariumSpecification\Term\Modifier\AndX;
use SolariumSpecification\Term\Modifier\Field;
use SolariumSpecification\Term\Phrase;
use SolariumSpecification\Term\Range;
use SolariumSpecification\Term\TermInterface;
use SolariumSpecification\TermSpecificationInterface;

require 'vendor/autoload.php';

// Only match results with a `last_updated_at` after a supplied DateTime
class UpdatedAfter implements TermSpecificationInterface
{
    private $updatedAfter;

    public function __construct(DateTimeImmutable $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }

    public function getTerm(): TermInterface
    {
        return new Field(
            'last_updated_at',
            new Range(new DateTime($this->updatedAfter))
        );
    }
}

// Only match results assign to a supplied `category`
class FilterByCategory implements TermSpecificationInterface
{
    private $category;

    public function __construct(TermInterface $category)
    {
        $this->category = $category;
    }

    public function getTerm(): TermInterface
    {
        return new Field(
            'category',
            $this->category
        );
    }
}

// Combine `UpdatedAfter` for the last week and `FilterByCategory` for 'Consumer Electronics'
class RecentlyUpdatedElectronics implements TermSpecificationInterface
{
    public function getTerm(): TermInterface
    {
        return new AndX([
            new UpdatedAfter(new DateTimeImmutable('-1 week')),
            new FilterByCategory(new Phrase('Consumer Electronics'))
        ]);
    }
}

// Solarium result class
class ProductsResult extends Result
{
}

// Set the result class to `ProductResult`
class ProductResult implements ModifyQuerySpecificationInterface
{
    public function getModifyQuery(): ModifyQueryInterface
    {
        return new SetResultClass(ProductsResult::class);
    }
}

// Set the query handler to `Products`
class ProductHandler implements ModifyQuerySpecificationInterface
{
    public function getModifyQuery(): ModifyQueryInterface
    {
        return new SetHandler('Products');
    }
}

// Combine the ProductResult and ProductHandler modify specifications
class Products implements ModifyQuerySpecificationInterface
{
    public function getModifyQuery(): ModifyQueryInterface
    {
        return new CompositeModify([
            new ProductResult(),
            new ProductHandler()
        ]);
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
The query will be 'last_updated_at:[2016-07-06T19:36:23Z] AND category:"Consumer Electronics"'.
The handler is Products.
The result class is ProductResult.
*/
```
