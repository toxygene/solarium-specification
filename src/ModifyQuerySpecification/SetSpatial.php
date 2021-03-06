<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use Solarium\QueryType\Select\Query\Component\Spatial;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

class SetSpatial implements ModifyQueryInterface, ModifyQuerySpecificationInterface
{
    /**
     * Distance
     *
     * @var float|null
     */
    private $distance;

    /**
     * Field
     *
     * @var string|null
     */
    private $field;

    /**
     * Point
     *
     * @var string|null
     */
    private $point;

    /**
     * Constructor
     *
     * @param float|null $distance
     * @param string|null $field
     * @param string|null $point
     */
    public function __construct(float $distance = null, string $field = null, string $point = null)
    {
        $this->distance = $distance;
        $this->field = $field;
        $this->point = $point;
    }

    /**
     * {@inheritdoc}
     */
    public function getModifyQuery(): ModifyQueryInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): ModifyQueryInterface
    {
        /** @var Spatial $spatial */
        $spatial = $query->getSpatial();

        if (null !== $this->distance) {
            $spatial->setDistance($this->distance);
        }

        if (null !== $this->field) {
            $spatial->setField($this->field);
        }

        if (null !== $this->point) {
            $spatial->setPoint($this->point);
        }

        return $this;
    }
}
