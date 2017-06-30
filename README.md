# Solarium Specification library

Create Solarium select queries using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

# Usage
```php
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\AbstractSpecification;
use SolariumSpecification\Equals;
use SolariumSpecification\FilterQuery;
use SolariumSpecification\Range;
use SolariumSpecification\Rows;
use SolariumSpecification\Sort;
use SolariumSpecification\Term\DateTime;

class ProductResult extends Result
{
}

class UpdatedAfter extends AbstractSpecification
{
    private $updatedAfter;
    
    public function __construct(DateTime $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }
    
    public function getSpec()
    {
        return new FilterQuery(
            'updated_after',
            new Range(
                'last_updated_at',
                new DateTime($this->>updatedAt)
            )
        );
    }
}

class FilterByCategory extends AbstractSpecification
{
    private $category;
    
    public function __construct($category)
    {
        $this->category = $category;
    }
    
    public function getSpec()
    {
        return new Equals(
            'category',
            $this->category
        );
    }
}

class RecentlyUpdatedElectronics extends AbstractSpecification
{
    public function getSpec()
    {
        return new AndX([
            new UpdatedAfter(new DateTime('-1 week')),
            new FilterByCategory(new Phrase('Consumer Electronics')),
            new SetResultClass(ProductResult::class)
        ]);
    }
}

$repository = new SpecificationRepository($solariumClient);
var_dump($repository->match(new RecentlyUpdatedElectronics())); // ProductResult
```
