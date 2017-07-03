# Solarium Specification library

Create Solarium select queries using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

# Usage
```php
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\Helper;
use SolariumSpecification\Filter\AndX;
use SolariumSpecification\Filter\Equals;
use SolariumSpecification\Filter\FilterInterface;
use SolariumSpecification\Filter\Range;
use SolariumSpecification\FilterSpecificationInterface;
use SolariumSpecification\ModifyQuery\CompositeModify;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\ModifyQuery\SetHandler;
use SolariumSpecification\ModifyQuery\SetResultClass;
use SolariumSpecification\ModifyQuerySpecificationInterface;
use SolariumSpecification\Repository;

require 'vendor/autoload.php';

// Only match results with a `last_updated_at` after a supplied DateTime
class UpdatedAfter implements FilterSpecificationInterface
{
    private $updatedAfter;

    public function __construct(DateTime $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }

    public function getFilter(): FilterInterface
    {
        return new Range(
            'last_updated_at',
            Helper::escapeDateTime($this->updatedAfter)
        );
    }
}

// Only match results assign to a supplied `category`
class FilterByCategory implements FilterSpecificationInterface
{
    private $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function getFilter(): FilterInterface
    {
        return new Equals(
            'category',
            $this->category
        );
    }
}

// Combine `UpdatedAfter` for the last week and `FilterByCategory` for 'Consumer Electronics'
class RecentlyUpdatedElectronics implements FilterSpecificationInterface
{
    public function getFilter(): FilterInterface
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

// Match results based on the specifications
var_dump(
    $repository->match(
        new RecentlyUpdatedElectronics(),
        new Products()
    )
); // ProductResult
```
