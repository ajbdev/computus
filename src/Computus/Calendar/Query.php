<?php
namespace Computus\Calendar;
use Computus\Calendar;

class Query
{
    protected $calendar;

    const SELECT_AVAILABLE  = 1;
    const SELECT_BUSY       = 2;

    protected $select;
    protected $selectDuration;

    public function __construct(Calendar $calendar) {
        $this->calendar = $calendar;
    }

    public function available($time)
    {
        $this->select = self::SELECT_AVAILABLE;
        // THIS SHOULD RETURN AVAILABLE DATE INTERVALS
    }

    public function events($criteria = null)
    {
        $this->select = self::SELECT_BUSY;
        // THIS SHOULD RETURN FILTERED EVENTS
    }

    public function between($start, $end)
    {
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
        foreach ($this->calendar as $events) {

        }
    }



}