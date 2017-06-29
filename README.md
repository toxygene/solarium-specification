# Solarium Specification library

Create Solarium select queries using the [Specification pattern](https://en.wikipedia.org/wiki/Specification_pattern).

# Usage
```php
use SolariumSpecification\AbstractSpecification;
use SolariumSpecification\Equals;
use SolariumSpecification\Range;
use SolariumSpecification\Term\DateTime;

class UpdatedAfterSpecification extends AbstractSpecification
{
    private $updatedAfter;
    
    public function __construct(DateTime $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;
    }
    
    public function getSpec()
    {
        return new Range(
            'last_updated_at',
            new DateTime($this->updatedAt)
        );
    }
}

class FilterByCategorySpecification extends AbstractSpecification
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
            new UpdatedAfterSpec(new DateTime('-1 week')),
            new FilterByCategorySpecification('Electronics')
        ]);
    }
}

$repository = new SpecificationRepository(getProductClient());
var_dump($repository->match(new RecentlyUpdatedElectronics())); // Solarium\QueryType\Select\Result\Result
```
