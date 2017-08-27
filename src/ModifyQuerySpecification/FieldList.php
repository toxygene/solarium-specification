<?php

declare(strict_types=1);

namespace SolariumSpecification\ModifyQuerySpecification;

use RuntimeException;
use Solarium\QueryType\Select\Query\Query;
use SolariumSpecification\ModifyQueryInterface;
use SolariumSpecification\ModifyQuerySpecificationInterface;

/**
 * Field list query modifier
 */
class FieldList implements ModifyQueryInterface, ModifyQuerySpecificationInterface
{
    /**
     * Add mode
     *
     * @var string
     */
    const ADD = 'add';

    /**
     * Set mode
     *
     * @var string
     */
    const SET = 'set';

    /**
     * Fields to add
     *
     * @var string[]
     */
    private $fields;

    /**
     * Mode
     *
     * @var string
     */
    private $mode;

    /**
     * Constructor
     *
     * @param string|string[] $fields
     * @param string|null $mode
     */
    public function __construct($fields, string $mode = null)
    {
        if (null === $mode) {
            $mode = self::ADD;
        }

        $this->fields = (array) $fields;
        $this->mode = $mode;
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
        switch ($this->mode) {
            case self::ADD:
                $query->addFields($this->fields);
                break;

            case self::SET:
                $query->setFields($this->fields);
                break;

            default:
                throw new RuntimeException(sprintf('Unknown mode "%s"', $this->mode));
        }

        
        return $this;
    }
}
