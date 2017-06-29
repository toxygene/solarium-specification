<?php

declare(strict_types=1);

namespace SolariumSpecification\Term;

use \DateTime as BaseDateTime;
use \DateTimeZone;

class DateTime implements TermInterface
{
    /**
     * Date/time
     *
     * @var DateTime
     */
    private $dateTime;
    
    /**
     * Constructor
     *
     * @param BaseDateTime $dateTime
     */
    public function __construct(BaseDateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $this->dateTime
            ->setTimezone(new DateTimeZone('UTC'));
            
        return $this->dateTime
            ->format('Y-m-d\TH:i:s\Z');
    }
}
