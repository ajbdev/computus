<?php

namespace Computus;

use Computus\Calendar\Event;
use Computus\Calendar\EventInterface;
use Computus\Calendar\Query;

class Calendar extends \SplMinHeap
{
    protected $name;
    protected $query = null;

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
     * @param mixed $event1
     * @param mixed $event2
     * @return int
     */
    public function compare($event1,$event2) {
        return $event1->compare($event2->getEnd());
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

    public function find()
    {
        return $this->getQuery();
    }
}