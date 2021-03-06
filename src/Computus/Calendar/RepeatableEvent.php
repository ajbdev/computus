<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 8/6/15
 * Time: 8:58 PM
 */

namespace Computus\Calendar;


class RepeatableEvent extends AbstractEvent
{
    /**
     * @var Schedule
     */
    public $schedule = null;

    public function schedule($cycle, $period, $interval = null) {
        $this->schedule = new Schedule();

        $this->schedule->setCycle($cycle);

        $this->schedule->setPeriod($period);

        $this->schedule->setInterval($interval);
    }

    /**
     * @param \DateTime $dateTime
     */
    public function compare(\DateTime $dateTime)
    {
        if ($this->schedule !== null) {

        }

        return parent::compare($dateTime);
    }

}