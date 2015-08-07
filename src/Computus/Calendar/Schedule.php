<?php

namespace Computus\Calendar;


class Schedule
{
    protected $interval;
    protected $cycle;

    protected $weekdays;
    protected $months;
    protected $years;

    const CYCLE_DAILY       = 1;
    const CYCLE_MONTHLY     = 2;
    const CYCLE_YEARLY      = 3;

    /**
     * @return mixed
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param mixed $interval
     */
    public function setInterval($interval)
    {
        $this->interval = intval($interval);
    }

    /**
     * @return mixed
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param mixed $cycle
     */
    public function setCycle($cycle)
    {
        if ($cycle < self::CYCLE_DAILY || $cycle > self::CYCLE_YEARLY) {
            throw new \InvalidArgumentException('Invalid cycle');
        }
        $this->cycle = $cycle;
    }
}