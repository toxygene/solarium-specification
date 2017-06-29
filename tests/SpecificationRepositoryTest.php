<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\SpecificationInterface;
use SolariumSpecification\SpecificationRepository;

/**
 * @coversDefaultClass SolariumSpecification\SpecificationRepository
 */
class SpecificationRepositoryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::match
     * @covers ::createQuery
     */
    public function testMatch()
    {
        $mockClient = $this->getMockBuilder(Client::class)
            ->setMethods(['createSelect', 'select'])
            ->getMock();

        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $mockClient->expects($this->once())
            ->method('createSelect')
            ->will($this->returnValue($mockQuery));

        $mockResult = $this->createMock(Result::class);

        $mockClient->expects($this->once())
            ->method('select')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue($mockResult));

        $specification = $this->getMockBuilder(SpecificationInterface::class)
            ->setMethods(['getFilter', 'modify'])
            ->getMock();

        $specification->expects($this->once())
            ->method('getFilter')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue(''));

        $specification->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        $repository = new SpecificationRepository($mockClient);

        $result = $repository->match($specification);
        
        $this->assertSame($result, $mockResult);
    }
}
