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
    public $schedule = null;

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