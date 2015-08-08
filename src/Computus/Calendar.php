<?php

namespace Computus;

use Computus\Calendar\Event;
use Computus\Calendar\EventInterface;
use Computus\Calendar\Query;

class Calendar extends \SplMinHeap
{
    protected $name;
    protected $query = null;
    protected $busyNonBusinessHours = true;

    public function __construct($name = null) {
        $this->name = $name;
    }

    public function getQuery() {
        if ($this->query === null) {
            $this->query = new Query($this);
        }
        return $this->query;
    }

    /**
     * @param Event $event
     *
     * @return $this
     */
    public function add(Event $event) {
        $this->insert($event);

        return $this;
    }

    /**
     * @param mixed $event1
     * @param mixed $event2
     *
     * @return int
     */
    public function compare($event1,$event2) {
        return $event1->compare($event2->getEnd());
    }


    /**
     * @param Calendar $calendar
     *
     * @return Calendar
     */
    public function combine(Calendar $calendar) {
        $combined = clone $this;
        foreach ($calendar as $event) {
            $combined->insert($event);
        }
        return $combined;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param EventInterface $event
     * @return bool
     */
    public function free(EventInterface $event) {
        return $this->find()
                    ->between($event->getStart(), $event->getEnd())
                    ->available($event->getDuration()) > 0
        ;
    }

    public function find()
    {
        return $this->getQuery();
    }

    /**
     * @return boolean
     */
    public function isBusyNonBusinessHours()
    {
        return $this->busyNonBusinessHours;
    }

    /**
     * @param boolean $busyNonBusinessHours
     */
    public function setBusyNonBusinessHours($busyNonBusinessHours)
    {
        $this->busyNonBusinessHours = $busyNonBusinessHours;
    }


}