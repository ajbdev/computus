<?php

namespace Computus;

use Computus\Calendar\Event;

class Calendar
{
    protected $name;
    protected $events = array();
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
     * @param Event $event
     */
    public function add(Event $event)
    {
        $this->events[] = $event;
    }

    public function find()
    {
        return $this->getQuery();
    }
}