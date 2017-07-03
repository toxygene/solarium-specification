<?php

declare(strict_types=1);

namespace SolariumSpecification\Test;

use PHPUnit\Framework\TestCase;
use Solarium\Core\Client\Client;
use Solarium\QueryType\Select\Query\Query;
use Solarium\QueryType\Select\Result\Result;
use SolariumSpecification\Filter\FilterInterface;
use SolariumSpecification\ModifyQuery\ModifyQueryInterface;
use SolariumSpecification\Repository;

class RepositoryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::match
     * @covers ::createQuery
     */
    public function testMatch()
    {
        $this->markTestIncomplete('Still working out architecture');

        /** @var \PHPUnit_Framework_MockObject_MockObject|Query $mockQuery */
        $mockQuery = $this->getMockBuilder(Query::class)
            ->getMock();

        $mockResult = $this->createMock(Result::Class);

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

        $mockFilter = $this->getMockBuilder(FilterInterface::class)
            ->setMethods(['getFilter'])
            ->getMock();

        $mockModifyQuery = $this->getMockBuilder(ModifyQueryInterface::class)
            ->setMethods(['modify'])
            ->getMock();

        $repository = new Repository($mockClient);

        $this->assertSame($mockResult, $repository->match($mockFilter, $mockModifyQuery));
    }
}
