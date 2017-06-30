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
        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject|Result $mockResult */
        $mockResult = $this->createMock(Result::class);

        /** @var \PHPUnit_Framework_MockObject_MockObject|Client $mockClient */
        $mockClient = $this->getMockBuilder(Client::class)
            ->setMethods(['createSelect', 'select'])
            ->getMock();

        $mockClient->expects($this->once())
            ->method('createSelect')
            ->will($this->returnValue($mockQuery));

        $mockClient->expects($this->once())
            ->method('select')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue($mockResult));

        /** @var \PHPUnit_Framework_MockObject_MockObject|SpecificationInterface $mockSpecification */
        $mockSpecification = $this->getMockBuilder(SpecificationInterface::class)
            ->setMethods(['getFilter', 'modify'])
            ->getMock();

        $mockSpecification->expects($this->once())
            ->method('getFilter')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnValue(''));

        $mockSpecification->expects($this->once())
            ->method('modify')
            ->with($this->identicalTo($mockQuery))
            ->will($this->returnSelf());

        $repository = new SpecificationRepository($mockClient);

        $result = $repository->match($mockSpecification);
        
        $this->assertSame($result, $mockResult);
    }
}
