# Solarium Specification library

Create Solarium select queries using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

# Usage
```php
use function SolariumSpecification\escapeDateTime;
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\ModifyQuery\CompositeModify;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\ModifyQuery\SetHandler;
use SolariumSpecification\ModifyQuery\SetResultClass;
use SolariumSpecification\ModifyQuerySpecificationInterface;
use SolariumSpecification\Repository;
use SolariumSpecification\TermSpecificationInterface;
use SolariumSpecification\Term\Modifier\AndX;
use SolariumSpecification\Term\Modifier\Equals;
use SolariumSpecification\Term\Modifier\Field;
use SolariumSpecification\Term\Range;
use SolariumSpecification\Term\Phrase;
use SolariumSpecification\Term\SingleTerm;

require 'vendor/autoload.php';

// Only match results with a `last_updated_at` after a supplied DateTime
class UpdatedAfter implements TermSpecificationInterface
{
    private $updatedAfter;

    public function __construct(DateTime $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }

    public function getTerm(): TermInterface
    {
        return new Field(
            'last_updated_at',
            new Range(new SingleTerm(escapeDateTime($this->updatedAfter)))
        );
    }
}

// Only match results assign to a supplied `category`
class FilterByCategory implements TermSpecificationInterface
{
    private $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function getTerm(): TermInterface
    {
        return new Field(
            'category',
            new Phrase($this->category)
        );
    }
}

// Combine `UpdatedAfter` for the last week and `FilterByCategory` for 'Consumer Electronics'
class RecentlyUpdatedElectronics implements TermSpecificationInterface
{
    public function getTerm(): TermInterface
    {
        return new AndX([
            new UpdatedAfter(new DateTime('-1 week')),
            new FilterByCategory(Helper::escapePhrase('Consumer Electronics'))
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
