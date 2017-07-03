<?php

namespace SolariumSpecification;

use SolariumSpecification\ModifyQuery\ModifyQueryInterface;

interface ModifyQuerySpecificationInterface
{
    public function getModifyQuery(): ModifyQueryInterface;
}
