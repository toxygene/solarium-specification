<?php

declare(strict_types=1);

namespace SolariumSpecification;

use RuntimeException;
use Solarium\QueryType\Select\Query\Query;

/**
 * Sort query modifier
 */
class Sort implements QueryModifierInterface
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
     * Sort direction
     *
     * @var string
     */
    private $direction;

    /**
     * Sort by
     *
     * @var string
     */
    private $sortBy;

    /**
     * Mode
     *
     * @var string
     */
    private $mode;

    /**
     * Constructor
     *
     * @param string $sortBy
     * @param string|null $direction
     * @param string|null $mode
     */
    public function __construct(string $sortBy, string $direction = null, string $mode = null)
    {
        if (null === $direction) {
            $direction = Query::SORT_ASC;
        }

        if (null === $mode) {
            $mode = self::ADD;
        }

        $this->sortBy = $sortBy;
        $this->direction = $direction;
        $this->mode = $mode;
    }
    
    /**
     * {@inheritdoc}
     */
    public function modify(Query $query): QueryModifierInterface
    {
        switch ($this->mode) {
            case self::ADD:
                $query->addSort($this->sortBy, $this->direction);
                break;

            case self::SET:
                $query->clearSorts()
                    ->addSort($this->sortBy, $this->direction);
                break;

            default:
                throw new RuntimeException(sprintf('Unknown mode "%s"', $this->mode));
        }

        return $this;
    }
}
