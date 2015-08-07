<?php
namespace Computus\Calendar;
use Computus\Calendar;

class Query
{
    protected $calendar;

    const FIND_AVAILABLE  = 1;
    const FIND_BUSY       = 2;

    protected $find;
    protected $findDuration;
    protected $findNumberOfEvents;
    protected $findStart;
    protected $findEnd;

    public function __construct(Calendar $calendar) {
        $this->calendar = $calendar;
    }

    public function reset()
    {
        $this->find = null;
        $this->findDuration = null;
        $this->findStart = null;
        $this->findEnd = null;
        $this->findNumberOfEvents = null;
    }

    public function available(\DateInterval $duration, $num = 1)
    {
        $this->select = self::FIND_AVAILABLE;
        $this->findDuration = $duration;
        $this->findNumberOfEvents = $num;
        // THIS SHOULD RETURN AVAILABLE DATE RANGES @todo: as events??

        return $this->execute();
    }

    public function events($criteria = null)
    {
        $this->select = self::FIND_BUSY;
        // THIS SHOULD RETURN FILTERED EVENTS

        return $this->execute();
    }

    public function between(\DateTime $start, \DateTime $end)
    {
        $this->findStart = $start;
        $this->findEnd = $end;

        return $this;
    }

    public function after(\DateTime $dateTime)
    {
        $this->findStart = $dateTime;

        return $this;
    }

    public function before(\DateTime $dateTime)
    {
        $this->findEnd = $dateTime;

        return $this;
    }

    public function excluding($criteria)
    {
        return $this;
    }

    public function at($date)
    {
        return $this;
    }

    protected function execute()
    {
        $result = new Calendar();

        if (!$this->findStart) {
            $this->findStart = new \DateTime();
        }

        foreach ($this->calendar as $event) {
            if ($event->getStart() < $this->findStart) {
                continue;
            }

            if ($this->find == self::FIND_BUSY && !$event->getAvailable()) {
                $result->insert($event);
            } else if ($this->find == self::FIND_AVAILABLE) {
                
            }

        }

        $this->reset();

        return $result;
    }
}